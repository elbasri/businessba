@extends(AdminCore())
@section('content')


    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">

                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/agents/create')}}" data-toggle="tooltip" title="{{trans('orbscope.add')}}  {{trans('orbscope.agents')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ url(AdminPath().'/agents/'.$show->id.'/edit')}}" data-toggle="tooltip" title="{{trans('orbscope.edit')}}  {{trans('orbscope.agents')}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <span data-toggle="tooltip" title="{{trans('orbscope.delete')}}  {{trans('orbscope.agents')}}">
                            <a data-toggle="modal" data-target="#myModal{{$show->id}}" class="btn btn-circle btn-icon-only btn-default" href="">
                                <i class="fa fa-trash"></i>
                            </a>
                        </span>
                        <div class="modal fade" id="myModal{{$show->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">{{trans('orbscope.delete')}} {{  $show->name }} !</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('orbscope.ask-delete')}}  {{ $show->name }} !
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([ 'method' => 'DELETE', 'route' => ['agents.destroy', $show->id] ]) !!}
                                        {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/agents')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.agents')}}"><i class="fa fa-list"></i></a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs nav-tabs-lg">
                            <li @if(url(AdminPath().'/agents/'.$show->id) == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id)}}" >{{trans('orbscope.agent_information')}}</a>
                            </li>

                            <li @if(url(AdminPath().'/agents/'.$show->id.'/calls') == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id.'/calls')}}" >{{trans('orbscope.calls')}}</a>
                            </li>

                            <li @if(url(AdminPath().'/agents/'.$show->id.'/mettings') == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id.'/mettings')}}" >{{trans('orbscope.meetings')}}</a>
                            </li>

                            <li @if(url(AdminPath().'/agents/'.$show->id.'/requests') == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id.'/requests')}}" >{{trans('orbscope.requests')}}</a>
                            </li>

                            <li @if(url(AdminPath().'/agents/'.$show->id.'/cil') == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id.'/cil')}}" >{{trans('orbscope.cil')}}</a>
                            </li>

                            <li @if(url(AdminPath().'/agents/'.$show->id.'/tcr') == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id.'/tcr')}}" >{{trans('orbscope.orders')}}</a>
                            </li>

                            <li @if(url(AdminPath().'/agents/'.$show->id.'/complains') == URL::current()) class="active" @endif>
                                <a href="{{url(AdminPath().'/agents/'.$show->id.'/complains')}}" >{{trans('orbscope.complains')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row static-info">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.name')}} : </strong>
                                            {{$show->name}}
                                            <br><hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.email')}} : </strong>
                                            <a href="mailto:{{$show->email}}">{{$show->email}}</a>
                                            <br><hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.agentType')}} : </strong>
                                            {{@VarByLang($agent_type->name,GetLanguage())}}
                                            <br><hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>{{trans('orbscope.status')}} : </strong>
                                            {{$show->type}}
                                            <br><hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-1"><strong>{{trans('orbscope.image')}} : </strong></div>
                                            <div class="col-md-11">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: auto">
                                                        <img src="{{ShowImage($show->image)}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <br><hr>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
