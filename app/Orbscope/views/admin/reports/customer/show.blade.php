@extends(AdminCore())
@section('content')
    <link rel="stylesheet" href="{{url('orbscope/admin')}}/datatables/dataTables.bootstrap{{GetLangAdds()}}.css">
    <script src="{{url('orbscope/admin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('orbscope/admin/assets/global/plugins/counterup/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('orbscope/admin/assets/global/plugins/counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{url('orbscope/admin/assets/pages/scripts/table-datatables-scroller.min.js')}}" type="text/javascript"></script>
    <script src="{{url('vendor/datatables/buttons.server-side.js')}}"></script>
    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <a href="{{ url(AdminPath().'/report/customers') }}" class="btn green pull-right">{{ trans('orbscope.back_to_search_page') }}</a>
                </div>
                <div class="portlet-body">
                    <div class="col-xs-12 text-cenetr" style="margin-bottom: 80px">
                        <div class="col-md-6 col-md-offset-3">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$count}}">{{$count}}</span>
                                    </div>
                                    <div class="desc">{{trans('orbscope.count')}}. {{trans('orbscope.of')}} {{trans('orbscope.Customers')}}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    {!! $dataTable->table(['class'=> 'table table-striped order-column table-bordered table-hover order-column'], true) !!}
                </div>
            </div>
        </div>
    </div>
    {!! $dataTable->scripts() !!}
@endsection
