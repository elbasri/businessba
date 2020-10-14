@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/agents')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.agents')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('orbscope.full-screen')}}"
                           title="{{trans('orbscope.full-screen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">

                        {!! Form::open(['files'=>true,'route'=>'team.store','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="name">اسم المستخدم <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    {!! Form::text('username',old('username'),['class'=>'form-control','id'=>'user_name','required'=>'required']) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="name">{{trans('orbscope.name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    {!! Form::text('name',old('name'),['class'=>'form-control','id'=>'name','required'=>'required']) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>

                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="email">{{trans('orbscope.email')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    {!! Form::email('email',old('email'),['class'=>'form-control','id'=>'email']) !!}
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="password">{{trans('orbscope.password')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{trans('orbscope.password')}}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="type"> الرتبة <span class="required" aria-required="true"> * </span></label>
                            <div class="col-md-10">
                                <select class="form-control select2-multiple" data-placeholder="الرتبة" id="multiple" name="type[]" multiple>
                                    <option></option>

                                    @if(auth()->user()->can('Add Financial_Officer') )
                                   @foreach(\App\Orbscope\Models\Type::where('rank','admin')->get() as $v)
                                    <option value="{{$v->id}}">{{trans('orbscope.'.$v->name)}}</option>
                                   @endforeach
                                    @elseif(auth()->user()->can('Add Resources_Officer') && auth()->user()->can('Add Sales_Officer'))
                                        <option value="10">مسئول موارد بشرية</option>
                                        @foreach(\App\Orbscope\Models\Type::where('rank','sales_manager')->get() as $v)
                                            <option value="{{$v->id}}">{{trans('orbscope.'.$v->name)}}</option>
                                        @endforeach
                                    @elseif(auth()->user()->can('Add Sales_Officer'))
                                        @foreach(\App\Orbscope\Models\Type::where('rank','sales_manager')->get() as $v)
                                            <option value="{{$v->id}}">{{trans('orbscope.'.$v->name)}}</option>
                                        @endforeach
                                    @elseif(auth()->user()->can('Add Sales_agent'))
                                        <option value="9">وكيل مبيعات</option>
                                    @elseif(auth()->user()->can('Add Resources_Officer'))

                                        <option value="10">مسئول موارد بشرية</option>

                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">


                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="ar_description">النبذة الشخصية</label>
                                <div class="col-md-10">
                                    {!! Form::textarea('details',old('details'),['class'=>'form-control','id'=>'ar_description']) !!}
                                    @if ($errors->has('details'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="portlet-title">

                                <div class="caption">
                                    <span class="caption-subject bold uppercase font-dark">بيانات التواصل</span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('whats_app') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label" for="ar_name"><i class="fa fa-whatsapp fa-2x"></i></label>

                                    <div class="col-md-9">
                                        {!! Form::text('whats_app',old('whats_app'),['class'=>'form-control','id'=>'whats_app']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label" for="ar_name"><i class="fa fa-facebook fa-2x"></i> </label>

                                    <div class="col-md-9">
                                        {!! Form::text('facebook',old('facebook'),['class'=>'form-control','id'=>'facebook']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-title">

                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">بيانات الدفع</span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('vodafon_cache') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="ar_name">فودافون كاش</label>

                                    <div class="col-md-10">
                                        {!! Form::text('vodafon_cache',old('vodafon_cache'),['class'=>'form-control','id'=>'vodafon_cache']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ribbon ribbon-left ribbon-color-default uppercase">البريد المصري</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('name_posta') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="ar_name">الاسم </label>

                                    <div class="col-md-10">
                                        {!! Form::text('name_posta',old('name_posta'),['class'=>'form-control','id'=>'name_posta']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('nationalnumber_posta') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="nationalnumber_posta">الرقم القومي </label>

                                    <div class="col-md-10">
                                        {!! Form::text('nationalnumber_posta',old('nationalnumber_posta'),['class'=>'form-control','id'=>'nationalnumber_posta']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-2 control-label" for="en_description">وسائل أخرى (اذكرها مع ذكر بياناتها) </label>
                                <div class="col-md-10">
                                    {!! Form::textarea('others',old('others'),['class'=>'form-control','id'=>'others']) !!}

                                </div>
                            </div>

                        </div>

                        </div>
                    <div class="clearfix"></div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.add')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <script src="{{url('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        CKEDITOR.replace( 'details', {
            toolbar : 'Basic',
            language: 'ar'
        });


    </script>
@endsection
