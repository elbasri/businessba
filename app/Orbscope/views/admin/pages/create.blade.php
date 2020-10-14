@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.js" type="text/javascript"></script>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/pages')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.pages')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">
                        {!! Form::open(['files'=>true,'route'=>'pages.store','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">

                            <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_name">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-9">
                                    {!! Form::text('ar_name',old('ar_name'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'),'required'=>'required']) !!}
                                    @if ($errors->has('ar_name'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('ar_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="en_name">{{trans('orbscope.en-name')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    {!! Form::text('en_name',old('en_name'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name'),'required']) !!}
                                    @if ($errors->has('en_name'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('en_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{trans('orbscope.category')}} <span class="required" aria-required="true"> * </span> </label>
                                <div class="col-md-9">

                                    <select name="cat_id" id="cat_id" class="form-control select2 cat_id" data-placeholder="{{trans('orbscope.category')}}" required>
                                        <option></option>
                                        @foreach($cats as $cont)
                                            <option value="{{$cont->id}}" @if(old('shop_id') == $cont->id) selected @endif>{{VarByLang($cont->name,GetLanguage())}}</option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>
                            </br>


                            <div class="form-group city_data hidden"></div>

                            <div class="form-group{{ $errors->has('ar_details') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_details">{{trans('orbscope.ar-details')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    {!! Form::textarea('ar_details',old('ar_details'),['class'=>'form-control','id'=>'ar_details','placeholder'=>trans('orbscope.ar-details'),'required'=>'required']) !!}
                                    @if ($errors->has('ar_details'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('ar_details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('en_details') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="en_details">{{trans('orbscope.en-details')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    {!! Form::textarea('en_details',old('en_details'),['class'=>'form-control','id'=>'en_details','placeholder'=>trans('orbscope.en-details'),'required']) !!}
                                    @if ($errors->has('en_details'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('en_details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('ar_description') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_description">{{trans('orbscope.ar-description')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    {!! Form::text('ar_description',old('ar_description'),['class'=>'form-control','id'=>'ar_description','placeholder'=>trans('orbscope.ar-description'),'required'=>'required']) !!}
                                    @if ($errors->has('ar_description'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('ar_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('en_description') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="en_description">{{trans('orbscope.en-description')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-9">
                                    {!! Form::text('en_description',old('en_description'),['class'=>'form-control','id'=>'en_description','placeholder'=>trans('orbscope.en-description'),'required']) !!}
                                    @if ($errors->has('en_description'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('en_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="status">{{trans('orbscope.status')}}</label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-placeholder="{{trans('orbscope.status')}}" name="status">
                                        <option value=""></option>
                                        <option value="active">{{ trans('orbscope.active') }}</option>
                                        <option value="inactive">{{ trans('orbscope.inactive') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="show_website">{{trans('orbscope.show_website')}}</label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-placeholder="{{trans('orbscope.show_website')}}" name="show_website" id="show_website">
                                        <option value=""></option>
                                        <option value="hide">{{ trans('orbscope.hide') }}</option>
                                        <option value="show">{{ trans('orbscope.show') }}</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group hidden" id="url">
                                <label class="col-md-3 control-label" for="url">{{trans('orbscope.url')}}</label>
                                <div class="col-md-9">
                                    {!! Form::text('url',old('url'),['class'=>'form-control','id'=>'url','placeholder'=>trans('orbscope.url')]) !!}
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.add')}} {{trans('orbscope.page')}}</button>
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

        $(document).on('change', '#show_website', function(event) {
            var val = $(this).val();
            if (val == 'show') {
                $('#url').removeClass('hidden');
            }else {
                $('#url').addClass('hidden');
            }
        });
        CKEDITOR.replace( 'ar_details', {
            toolbar : 'Basic',
            language: '{{GetLanguage()}}'
        });
        CKEDITOR.replace( 'en_details', {
            toolbar : 'Basic',
            language: '{{GetLanguage()}}'
        });

        $(document).on('change', '#cat_id', function () {
            var cat = $(this).val();
            $.ajax({
                url: '{{url(AdminPath().'/cat/ajax')}}',
                dataType: 'html',
                type: 'post',
                data: {_token: '{{csrf_token()}}', cat: cat},
                beforeSend: function () {
                    $('.city_data').removeClass('hidden');
                }, success: function (data) {
                    $('.city_data').html(data);
                    $('select[name="sub_id"]').val("{{old('sub_id')}}").select2();
                }
            });
        });
    </script>


@endsection
