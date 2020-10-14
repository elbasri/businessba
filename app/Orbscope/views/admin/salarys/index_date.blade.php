@extends(AdminCore())
@section('content')

    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/css/multi-select{{GetLangAdds()}}.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>

    <link href="{{url('orbscope/admin')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('orbscope/admin')}}/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <style>
        table {
            table-layout: fixed; !important;
        }
        table{
            display: block; !important;
            overflow-x: auto; !important;
            white-space: nowrap; !important;

        }
    </style>


    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" >
                            <a class="btn red btn-outline btn-circle btn-sm" href="{{url(AdminPath().'/employees/salarys')}}">{{trans('orbscope.salarys')}}</a>
                            <a class="btn red btn-outline btn-circle btn-sm" href="{{url(AdminPath().'/agents')}}">{{trans('orbscope.agents')}}</a>
                        </div>
                    </div>
                </div>

                <div class="portlet-body">

                    <div class="table-toolbar">

                        <div class="row">

                            <form method="post" action="{{url(AdminPath().'/date_salarys/search')}}">
                                {!! csrf_field() !!}
                                <div class="col-md-12">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="from_date">{{trans('orbscope.date_range')}}</label>
                                            <div class="col-md-10">
                                                <div class="input-group date-picker input-daterange"  data-date-format="yyyy-mm-dd" >
                                                    {!! Form::text('from_date',old('from_date'),['class'=>'date-picker form-control','placeholder'=>trans('orbscope.from'),'readonly'=>'readonly']) !!}
                                                    <span class="input-group-addon"> {{trans('orbscope.to')}} </span>
                                                    {!! Form::text('to_date',old('to_date'),['class'=>'date-picker form-control','placeholder'=>trans('orbscope.to'),'readonly'=>'readonly','id'=>'to_date']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="assgin_user" value="user" style=" margin-bottom: 20px; width:100%;" class="btn blue">{{trans('orbscope.search')}}</button>
                                    </div>
                                </div>
                            </form>

                            <form method="post" action="{{url(AdminPath().'/depart_branch/search')}}">
                                {!! csrf_field() !!}
                                <div class="col-md-12">
                                    <div class="col-md-5">

                                        <td><select name="user"  class="form-control select2" data-placeholder="{{trans('orbscope.branch')}}" >
                                                <option></option>
                                                @foreach($branch as $b)
                                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                                @endforeach

                                            </select></td>

                                    </div>
                                    <div class="col-md-5">

                                        <td><select name="user"  class="form-control select2" data-placeholder="{{trans('orbscope.department')}}" >
                                                <option></option>
                                                @foreach($depart as $d)
                                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                                @endforeach

                                            </select></td>

                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="assgin_user" value="user" style=" margin-bottom: 20px; width:100%;" class="btn blue">{{trans('orbscope.search')}}</button>
                                    </div>

                                </div>
                            </form>

                        </div>

                        <br/>


                    </div>
                </div>


                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th><i class="fa fa-plus"></i></th>
                        <th>{{trans('orbscope.agent')}}</th>
                        <th>{{trans('orbscope.branch')}}</th>
                        <th>{{trans('orbscope.salary')}}</th>
                        <th>{{trans('orbscope.date')}}</th>
                        <th>{{trans('orbscope.leaving_date')}}</th>
                        <th>{{trans('orbscope.total_subtract')}}</th>
                        <th>{{trans('orbscope.total_add')}}</th>
                        <th>{{trans('orbscope.net_profit')}}</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salarys as $k=>$agent)
                        <tr>
                            <td>{{$k+1}} </td>
                            <td><a href="{{url('admin/agent/'.@$agent->agent->id.'/salary')}}"><i class="fa fa-external-link"></i> {{@$agent->agent->name}} </a></td>
                            <td>{{@$agent->agent->branch->name}}</td>
                            <td>{{@$agent->salary}}</td>
                            <td>{{$agent->date}}</td>
                            <td>{{$agent->agent->end_date}}</td>
                            <td></td>
                            <td></td>
                            <td></td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </form>
            </div>

        </div>

    </div>


    <!-- Modal -->





    <script src="{{url('orbscope/admin')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
@endsection
