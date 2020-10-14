@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{url('orbscope/admin/assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{url('orbscope/admin')}}/datatables/dataTables.bootstrap{{GetLangAdds()}}.css">
    <script src="{{url('orbscope/admin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.buttons.min.js')}}"></script>
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
                    {!! Form::open([ 'method' => 'post', 'url' => [AdminPath().'/Invoice/multi_delete'] ]) !!}
                    {!! $dataTable->table(['class'=> 'table table-striped table-bordered table-hover'],true) !!}
                </div>
            </div>
        </div>
        <script>

            $(document).on('click', '.createBtn', function() {
                window.location = "Invoice/create";
            });


            $(document).on('click', '.deleteBtn', function() {
                $('#multi_delete').modal('show');
                var number_checkbox = $(".selected_data").filter(":checked").length;
                $('#count').html(number_checkbox);
                if(number_checkbox > 0){
                    $('.delete_done').show();
                    $('.check_delete').hide();
                }else{
                    $('.delete_done').hide();
                    $('.check_delete').show();
                }
            });


        </script>
    </div>
    <div class="modal fade" id="multi_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">{{trans('orbscope.delete')}} </h4>
                </div>
                <div class="modal-body">
                    <div class="delete_done"> {{trans('orbscope.ask-delete')}} <span id="count"></span> {{trans('orbscope.record')}} ! </div>
                    <div class="check_delete">{{trans('orbscope.check-delete')}}</div>
                </div>
                <div class="modal-footer">

                    <input type="submit" name="delete" value="{{trans('orbscope.approval')}}" class="btn btn-danger delete_done">
                    <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    {!! $dataTable->scripts() !!}
@endsection
