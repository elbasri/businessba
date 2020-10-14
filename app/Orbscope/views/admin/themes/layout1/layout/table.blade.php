@extends(AdminCore())
@section('content')
    <link rel="stylesheet" href="{{url('orbscope/admin')}}/datatables/dataTables.bootstrap{{GetLangAdds()}}.css">
    <script src="{{url('orbscope/admin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('vendor/datatables/buttons.server-side.js')}}"></script>
    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    {!! $dataTable->table(['class'=> 'table table-striped table-bordered table-hover']) !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.createBtn', function() {
            window.location = "countries/create";
        });
    </script>

    {!! $dataTable->scripts() !!}
  
@endsection


