@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/css/multi-select{{GetLangAdds()}}.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <style>
    .extraClass{
        font-size:50px;
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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/roles')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.roles')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">
                        <div class="row">
                            {!! Form::open(['files'=>true,'url'=>AdminPath().'/roles','method'=>'post','class'=>'form-horizontal form-row-seperated']) !!}
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">{{trans('orbscope.role_name')}}</label>
                                <div class="col-md-9">
                                    {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('orbscope.role_name')]) !!}
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class="col-md-3 control-label">{{ trans('orbscope.assign_permissions') }}</label>
                                <div class="col-md-9">
                                    <input type="checkbox" class="select-all" name="permissions[]" onclick="select_all()" value="Admin">
                                     {{ Form::label('All', 'All') }}
                                    <hr>
                                    @foreach ($permissions->chunk(4) as $permissionChunck)
                                        <div class="row">
                                            @foreach ($permissionChunck as $permission)
                                                <div class="col-md-3">
                                                    <input type="checkbox" class="selected_data" name="permissions[]" value="{{ $permission->id }}">
                                                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn blue">{{trans('orbscope.add')}} {{trans('orbscope.roles')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
