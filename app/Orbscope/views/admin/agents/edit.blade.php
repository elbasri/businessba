@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
    type="text/css"/>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
    type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
    type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/css/multi-select{{GetLangAdds()}}.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/jquery.quicksearch.js" type="text/javascript"></script>

    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/agents')}}" data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.agents')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">

                    <ul class="nav nav-tabs nav-tabs-lg">
                        <li class="{{ url()->current() == url(AdminPath().'/agents/'.$edit->id.'/edit') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/agents/'.$edit->id.'/edit')}}" >{{trans('orbscope.general')}}</a>
                        </li>
                        <li class="{{ url()->current() == url(AdminPath().'/postion_historical/'.$edit->id.'/edit') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/postion_historical/'.$edit->id)}}" >{{trans('orbscope.postion_historical')}} <i class="fa fa-history"></i></a>
                        </li>
                        <li class="{{ url()->current() == url(AdminPath().'/branch_historical/'.$edit->id.'/edit') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/branch_historical/'.$edit->id)}}" >{{trans('orbscope.branch_historical')}} <i class="fa fa-history"></i></a>
                        </li>
                        <li class="{{ url()->current() == url(AdminPath().'/depart_historical/'.$edit->id.'/edit') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/depart_historical/'.$edit->id)}}" >{{trans('orbscope.depart_historical')}} <i class="fa fa-history"></i></a>
                        </li>
                        <li class="{{ url()->current() == url(AdminPath().'/agent/'.$edit->id.'/salary') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/agent/'.$edit->id.'/salary')}}" >{{trans('orbscope.salary')}} <i class="fa fa-dollar"></i></a>
                        </li>
                        <li class="{{ url()->current() == url(AdminPath().'/agent/'.$edit->id.'/vacations') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/agent/'.$edit->id.'/vacations')}}" >{{trans('orbscope.vacations')}} </a>
                        </li>
                        <li class="{{ url()->current() == url(AdminPath().'/agent/'.$edit->id.'/stay') ? ' active' : '' }}">
                            <a href="{{url(AdminPath().'/agent/'.$edit->id.'/stay')}}" >{{trans('orbscope.stay')}} </a>
                        </li>
                    </ul>

                    <div class="col-md-12">
                        {!! Form::open(['files'=>true, 'url' =>AdminPath().'/agents/'.$edit->id,'method' => 'PUT','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="ar_name">{{trans('orbscope.ar-name')}} <span class="required" aria-required="true"> * </span></label>

                                <div class="col-md-10">
                                    {!! Form::text('ar_name',VarByLang($edit->name,'ar'),['class'=>'form-control','id'=>'ar_name','placeholder'=>trans('orbscope.ar-name'),'required'=>'required']) !!}
                                    <i class="fa fa-spinner fa-spin loading hidden"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">

                            <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label" for="en_name">{{trans('orbscope.en-name')}} <span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-10">
                                    {!! Form::text('en_name',VarByLang($edit->name,'en'),['class'=>'form-control','id'=>'en_name','placeholder'=>trans('orbscope.en-name')]) !!}
                                    @if ($errors->has('en_name'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('en_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('work_mobile') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="name">{{trans('orbscope.work_mobile')}} </label>

                                    <div class="col-md-10">
                                        {!! Form::text('work_mobile',$edit->work_mobile,['class'=>'form-control','id'=>'work_mobile','placeholder'=>trans('orbscope.work_mobile')]) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('personal_mobile') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="personal_mobile">{{trans('orbscope.personal_mobile')}} </label>

                                    <div class="col-md-10">
                                        {!! Form::text('personal_mobile',$edit->personal_mobile,['class'=>'form-control','id'=>'personal_mobile','placeholder'=>trans('orbscope.personal_mobile')]) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="name">{{trans('orbscope.code')}} </label>

                                    <div class="col-md-10">
                                        {!! Form::text('code',$edit->code,['class'=>'form-control','id'=>'code','placeholder'=>trans('orbscope.code')]) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.department')}} </label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" name="department" id="department" data-placeholder="{{trans('orbscope.department')}}">
                                            <option></option>
                                            @foreach($depart as $type)
                                                <option value="{{$type->id}}" {{$edit->depart_id==$type->id?'selected':''}}>{{VarByLang($type->name,GetLanguage())}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="date">{{trans('orbscope.start_date')}}<span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        {!! Form::text('start_date',$edit->start_date,['class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd','placeholder'=>trans('orbscope.start_date')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="date">{{trans('orbscope.end_date')}}</label>
                                    <div class="col-md-10">
                                        {!! Form::text('end_date',$edit->end_date,['class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd','placeholder'=>trans('orbscope.end_date')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="email">{{trans('orbscope.email')}} </label>

                                    <div class="col-md-10">
                                        {!! Form::email('email',$edit->email,['class'=>'form-control','placeholder'=>trans('orbscope.email')]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.city')}} </label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" name="city" id="city" data-placeholder="{{trans('orbscope.city')}}">
                                            <option></option>
                                            @foreach($city as $type)
                                                <option value="{{$type->id}}" {{$edit->city_id==$type->id?'selected':''}}>{{VarByLang($type->name,GetLanguage())}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="date">{{trans('orbscope.birth_date')}}</label>
                                    <div class="col-md-10">
                                        {!! Form::text('birth_date',$edit->birth_date,['class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd','placeholder'=>trans('orbscope.birth_date')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label" for="name">{{trans('orbscope.address')}} </label>

                                    <div class="col-md-10">
                                        {!! Form::text('address',$edit->address,['class'=>'form-control','id'=>'address','placeholder'=>trans('orbscope.address')]) !!}
                                        <i class="fa fa-spinner fa-spin loading hidden"></i>
                                    </div>

                                </div>
                            </div>




                        </div>
                            <div class="row">


                                <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="date">{{trans('orbscope.note')}}</label>
                                    <div class="col-md-10">
                                        {!! Form::textarea('notes',$edit->notes,['class'=>'form-control','placeholder'=>trans('orbscope.note')]) !!}
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.edit')}} {{trans('orbscope.agent')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>

@endsection
