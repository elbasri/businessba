@if($status=='inactive')
<a href="{{ url(AdminPath().'/user/'.$id.'/active')}}" class="btn blue">{{trans('orbscope.active')}}</a>
@else
<a href="{{ url(AdminPath().'/user/'.$id.'/inactive')}}" class="btn btn-danger">{{trans('orbscope.inactive')}}</a>
@endif