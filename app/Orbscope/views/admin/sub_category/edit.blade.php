@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <style media="screen">
        .icon-select-box, .icon-select-box option {
            font-family: 'FontAwesome', 'sans-serif' !important;
        }
    </style>

    <div class='row'>
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>

                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/sub_category')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('sub_category')}}">
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

                        {!! Form::open(['files'=>true,'url'=>AdminPath().'/sub_category/'.$edit->id,'method'=>'put','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">
                            <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label" for="ar_name">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-9">
                                    {!! Form::text('ar_name',VarByLang($edit->name,'ar'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'),'required'=>'required']) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                            </div>



                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.edit')}} {{trans('orbscope.sub_category')}}</button>
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

@endsection
