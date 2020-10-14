@extends(AdminCore())
@section('content')
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
                        <span class="caption-subject bold uppercase font-dark">{{$title}} : {{$show->name}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/roles/create')}}" data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.roles')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/roles/'.$show->id.'/edit')}}" data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.roles')}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.roles')}}">

                            <a data-toggle="modal" data-target="#myModal{{$show->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                                <i class="fa fa-trash"></i>
                            </a>
                        </span>
                        <div class="modal fade" id="myModal{{$show->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('orbscope.delete')}} {{$show->id}} !</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('orbscope.ask-delete')}}  {{$show->id}} !
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $show->id]]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/roles')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.roles')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <br>
                    <br>
                    <br>
                    <div class="col-md-12">
                        {!! $dataTable->table(['class'=> 'table table-striped table-bordered table-hover'],true) !!}
                    </div>
                    <hr>
                    <div class="col-md-12">
                        @foreach ($show->permissions()->pluck('name')->chunk(4) as $Chunkedvalue)
                            <div class="col-md-4">
                                <ul class="list-group">
                                    @foreach ($Chunkedvalue as $val)
                                        <li class="list-group-item">{{ $val }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
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

                {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger delete_done']) !!}
                <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>

            </div>
        </div>
    </div>
</div>

{!! $dataTable->scripts() !!}
<script type="text/javascript">
$(document).on('click', '.createBtn', function() {
    window.location = "{{url(AdminPath().'/agents/create')}}";
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
@endsection
