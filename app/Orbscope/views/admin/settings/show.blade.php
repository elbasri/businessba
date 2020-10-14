@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/css/multi-select{{GetLangAdds()}}.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('settings.edit') }}" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 name">
                                <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="ar_name">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        {!! Form::text('ar_name',VarByLang($show->name, 'ar'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'), 'required']) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 name">
                                <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="en_name">{{trans('orbscope.en-name')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        {!! Form::text('en_name',VarByLang($show->name, 'en'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name'), 'required']) !!}
                                        @if ($errors->has('en_name'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('en_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 name">
                                <div class="form-group{{ $errors->has('copy_right') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="en_name">{{trans('orbscope.Copyright')}}<span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        {!! Form::text('copy_right',$show->copy_right,['class'=>'form-control','id'=>'en_name','placeholder'=>'@Copyright', 'required']) !!}
                                        @if ($errors->has('copy_right'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('copy_right') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 email">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="email">{{trans('orbscope.email')}}</label>
                                    <div class="col-md-4">
                                        {!! Form::email('email', $show->email,['class'=>'form-control','id'=>'email','placeholder'=>trans('orbscope.email')]) !!}
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <label class="col-md-2 control-label" for="phone">{{trans('orbscope.phone')}} </label>
                                    <div class="col-md-4">
                                        {!! Form::number('phone',$show->phone,['class'=>'form-control','id'=>'phone','placeholder'=>trans('orbscope.phone')]) !!}
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mobile">
                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="mobile">{{trans('orbscope.mobile')}} </label>
                                    <div class="col-md-10">
                                        {!! Form::text('mobile', $show->mobile, ['class'=>'form-control','id'=>'mobile','placeholder'=>trans('orbscope.mobile')]) !!}
                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mobile">

                                    <label class="col-md-2 control-label" for="login_color">{{trans('orbscope.login_color')}} </label>
                                    <div class="col-md-4">
                                        {!! Form::color('login_color',$show->login_color,['class'=>'form-control','id'=>'login_color','placeholder'=>trans('orbscope.login_color')]) !!}
                                        @if ($errors->has('login_color'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('login_color') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 logo">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="logo">{{trans('orbscope.logo')}} </label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{ ShowImage($show->logo) }}" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> {{trans('orbscope.select-image')}}</span>
                                                    <span class="fileinput-exists"> {{trans('orbscope.change')}} </span>
                                                    <input type="file" name="logo" id="logo" accept=".image/jpeg,.png,.jpg,.bmp,.gif">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('orbscope.remove')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="col-md-2 control-label" for="icon">{{trans('orbscope.icon')}} </label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{ ShowImage($show->icon) }}" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> {{trans('orbscope.select-image')}}</span>
                                                    <span class="fileinput-exists"> {{trans('orbscope.change')}} </span>
                                                    <input type="file" name="icon_image" id="icon" accept=".image/jpeg,.png,.jpg,.bmp,.gif,.ico">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('orbscope.remove')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 keywords">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="keywords">{{trans('orbscope.keywords')}}</label>
                                    <div class="col-md-5">
                                        <input type="text" name="ar_keywords" id="ar_keywords" placeholder="{{trans('orbscope.ar_keywords')}}" class="form-control" value="{{@VarByLang($show->keywords,'ar')}}">
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="en_keywords" id="en_keywords" placeholder="{{trans('orbscope.en_keywords')}}" class="form-control" value="{{@VarByLang($show->keywords,'en')}}">
                                    </div>
                                </div>
                            </div>






                            <div class="col-md-12 language">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="language">{{trans('orbscope.language')}}</label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" data-placeholder="{{trans('orbscope.language')}}" name="language">
                                            <option value=""></option>
                                            <option value="ar" {{ $show->language == 'ar' ? ' selected' : '' }}>{{trans('orbscope.arabic')}}</option>
                                            <option value="en" {{ $show->language == 'en' ? ' selected' : '' }}>{{trans('orbscope.english')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 multi_lang">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="multi_lang">{{trans('orbscope.multi_lang')}} </label>
                                    <div class="col-md-4">
                                        <select class="form-control select2" data-placeholder="{{trans('orbscope.multi_lang')}}" name="multi_lang">
                                            <option value=""></option>
                                            <option value="yes" {{ $show->multi_lang == 'yes' ? ' selected' : '' }}>{{trans('orbscope.yes')}}</option>
                                            <option value="no" {{ $show->multi_lang == 'no' ? ' selected' : '' }}>{{trans('orbscope.no')}}</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label" for="allow_register">{{trans('orbscope.allow_register')}} </label>
                                    <div class="col-md-4">
                                        <select class="form-control select2" data-placeholder="{{trans('orbscope.allow_register')}}" name="allow_register">
                                            <option value=""></option>
                                            <option value="yes" {{ $show->allow_register == 'yes' ? ' selected' : '' }}>{{trans('orbscope.yes')}}</option>
                                            <option value="no" {{ $show->allow_register == 'no' ? ' selected' : '' }}>{{trans('orbscope.no')}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-12 session_timeout">
                                <div class="form-group{{ $errors->has('session_timeout') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="session_timeout">{{trans('orbscope.session_timeout')}} ({{trans('orbscope.in_seconds')}})</label>
                                    <div class="col-md-10">
                                        {!! Form::number('session_timeout',$show->session_timeout,['class'=>'form-control','id'=>'session_timeout','placeholder'=>trans('orbscope.session_timeout')]) !!}
                                        @if ($errors->has('session_timeout'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('session_timeout') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 address">
                                <div class="form-group{{ $errors->has('ar_address') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="ar_address">{{trans('orbscope.address')}} </label>

                                    <div class="col-md-5">
                                        {!! Form::text('ar_address',@VarByLang($show->address,'ar'),['class'=>'form-control','id'=>'ar_address','placeholder'=>trans('orbscope.ar-address')]) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                    <div class="col-md-5">
                                        {!! Form::text('en_address',@VarByLang($show->address,'en'),['class'=>'form-control','id'=>'en_address','placeholder'=>trans('orbscope.en-address')]) !!}
                                        @if ($errors->has('en_name'))
                                            <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('en_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div style="margin-bottom: 20px;" class="col-md-12 contact_title">


                                <label class="col-md-2 control-label" for="facebook">{{trans('orbscope.facebook')}} </label>

                                <div class="col-md-4">
                                    {!! Form::url('facebook',$show->facebook,['class'=>'form-control','id'=>'facebook','placeholder'=>trans('orbscope.facebook')]) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>



                                <label class="col-md-2 control-label" for="facebook">{{trans('orbscope.twitter')}} </label>


                                <div class="col-md-4">
                                    {!! Form::url('twitter',$show->twitter,['class'=>'form-control','id'=>'twitter','placeholder'=>trans('orbscope.twitter')]) !!}
                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('facebook') }}</strong>
                                            </span>
                                    @endif
                                </div>

                            </div>



                            <div class="col-md-12">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-block blue">{{trans('orbscope.edit')}} <i class="fa fa-edit"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
