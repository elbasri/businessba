@if (auth()->user()->can('Show Representor_Details') )
<a href="{{ url(AdminPath().'/Representor_Details/'.$id)}}" class="btn btn-success">{{trans('orbscope.show')}}</a>
@endif