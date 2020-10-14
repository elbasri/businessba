@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/jquery-multi-select/css/multi-select{{GetLangAdds()}}.css" rel="stylesheet" type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('orbscope.full-screen')}}" title="{{trans('orbscope.full-screen')}}"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    {{-- `address`, `time`, `date`, `store_id`, `client_id`, `total`, `discount`, `net`, `total_plus_tax` --}}
                    <form method="get" action="{{ route('report.customer') }}">

                     <!--

                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('orbscope.Customer')}}</label>
                            <div class="col-md-10">
                                <select name="customer_id" id="client_id" class="form-control select2 client_id" data-placeholder="{{trans('orbscope.Customer')}}" >
                                    <option></option>
                                    @foreach($clients as $cont)
                                        <option value="{{$cont->id}}">{{ $cont->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        -->

                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('orbscope.customer_type')}}</label>
                            <div class="col-md-10">
                                <select name="type_id" id="" class="form-control select2 store_id" data-placeholder="{{trans('orbscope.customer_type')}}" >
                                    <option></option>
                                    @foreach($types as $cont)
                                        <option value="{{$cont->id}}">{{ $cont->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('orbscope.agent')}}</label>
                            <div class="col-md-10">
                                <select name="agent_id" id="agent_id" class="form-control select2 client_id" data-placeholder="{{trans('orbscope.agent')}}" >
                                    <option></option>
                                    @foreach($empolyee as $cont)
                                        <option value="{{$cont->id}}">{{ $cont->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('orbscope.city')}}</label>
                            <div class="col-md-10">
                                <select name="city_id" id="city_id" class="form-control select2" data-placeholder="{{trans('orbscope.city')}}" >
                                    <option></option>
                                    @foreach($city as $cont)
                                        <option value="{{$cont->id}}">{{ VarByLang($cont->name,GetLanguage()) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-2 control-label" for="date_from">{{trans('orbscope.date_range')}}</label>
                            <div class="col-md-10">
                                <div class="input-group date-picker input-daterange"  data-date-format="yyyy-mm-dd" >
                                    {!! Form::text('date_from',old('date_from'),['class'=>'date-picker form-control','placeholder'=>trans('orbscope.from'),'readonly'=>'readonly']) !!}
                                    <span class="input-group-addon"> {{trans('orbscope.to')}} </span>
                                    {!! Form::text('date_to',old('date_to'),['class'=>'date-picker form-control','placeholder'=>trans('orbscope.to'),'readonly'=>'readonly','id'=>'date_to']) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn blue">{{ trans('orbscope.search') }} <i class="fa fa-search"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <hr/>
                    <form  action="{{route('customer_report')}}" method="get"  name="customers">
                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('orbscope.Customers')}}</label>
                            <div class="col-md-10">
                                <select name="clients[]"  required class="form-control select2 client_id" data-placeholder="{{trans('orbscope.Customers')}}" multiple>
                                    <option></option>
                                    @foreach($clients as $cont)
                                        <option value="{{$cont->id}}">{{ $cont->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn blue">{{ trans('orbscope.search') }} <i class="fa fa-search"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <hr/>

                    <form>
                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('orbscope.agents')}}</label>
                            <div class="col-md-10">
                                <select name="agents[]"  class="form-control select2 client_id" data-placeholder="{{trans('orbscope.agents')}}" multiple>
                                    <option></option>
                                    @foreach($empolyee as $cont)
                                        <option value="{{$cont->id}}">{{ $cont->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn blue">{{ trans('orbscope.search') }} <i class="fa fa-search"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
