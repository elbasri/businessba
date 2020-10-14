<ul class="nav nav-tabs nav-tabs-lg">
    <li class="{{ url()->current() == url(AdminPath().'/agents/'.$agent->id.'/edit') ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/agents/'.$agent->id.'/edit')}}" >{{trans('orbscope.general')}}</a>
    </li>
    <li class="{{ url()->current() == url(AdminPath().'/postion_historical/'.$agent->id) ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/postion_historical/'.$agent->id)}}" >{{trans('orbscope.postion_historical')}} <i class="fa fa-history"></i></a>
    </li>
    <li class="{{ url()->current() == url(AdminPath().'/branch_historical/'.$agent->id) ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/branch_historical/'.$agent->id)}}" >{{trans('orbscope.branch_historical')}} <i class="fa fa-history"></i></a>
    </li>
    <li class="{{ url()->current() == url(AdminPath().'/depart_historical/'.$agent->id) ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/depart_historical/'.$agent->id)}}" >{{trans('orbscope.depart_historical')}} <i class="fa fa-history"></i></a>
    </li>
    <li class="{{ url()->current() == url(AdminPath().'/agent/'.$agent->id.'/salary') ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/agent/'.$agent->id.'/salary')}}" >{{trans('orbscope.salary')}} <i class="fa fa-dollar"></i></a>
    </li>
    <li class="{{ url()->current() == url(AdminPath().'/agent/'.$agent->id.'/vacations') ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/agent/'.$agent->id.'/vacations')}}" >{{trans('orbscope.vacations')}} </a>
    </li>
    <li class="{{ url()->current() == url(AdminPath().'/agent/'.$agent->id.'/stay') ? ' active' : '' }}">
        <a href="{{url(AdminPath().'/agent/'.$agent->id.'/stay')}}" >{{trans('orbscope.stay')}} </a>
    </li>
</ul>