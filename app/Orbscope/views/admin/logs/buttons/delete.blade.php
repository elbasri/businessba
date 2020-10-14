@if($type=='delete')

    <a href="{{ url(AdminPath().'/logs/'.$id.'/recover')}}" class="btn btn-warning">{{trans('orbscope.recover')}}</a>
@endif

