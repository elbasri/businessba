@extends(AdminCore())
@section('content')
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css" />
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{url(AdminPath().'/Invoice')}}"
                           data-toggle="tooltip" title="{{trans('orbscope.show-all')}}   {{trans('orbscope.invoice_types')}}">
                            <i class="fa fa-list"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"
                           data-original-title="{{trans('orbscope.full-screen')}}"
                           title="{{trans('orbscope.full-screen')}}">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12">
                        {!! Form::open(['files'=>true,'route'=>'Invoice.store','class'=>'form-horizontal form-row-seperated']) !!}
                        <div class="row">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                                        <label class="col-md-2 control-label" for="name">{{trans('orbscope.code')}} </label>

                                        <div class="col-md-10">
                                            {!! Form::text('invoice_number',old('invoice_number'),['class'=>'form-control','id'=>'invoice_number','placeholder'=>trans('orbscope.code')]) !!}
                                            <i class="fa fa-spinner fa-spin loading hidden"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.Customer')}} </label>
                                        <div class="col-md-10">
                                            <select class="form-control select2" name="customer_id" id="customer_id" data-placeholder="{{trans('orbscope.Customer')}}">
                                                <option></option>
                                                @foreach($cust as $type)
                                                    <option value="{{$type->id}}">{{VarByLang($type->name,GetLanguage())}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label class="col-md-2 control-label" for="name">{{trans('orbscope.amount_money')}} </label>

                                        <div class="col-md-10">
                                            {!! Form::text('amount',old('amount'),['class'=>'form-control','id'=>'amount','placeholder'=>trans('orbscope.amount_money')]) !!}
                                            <i class="fa fa-spinner fa-spin loading hidden"></i>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.currency')}} </label>
                                        <div class="col-md-10">
                                            <select class="form-control select2" name="currency_id"  data-placeholder="{{trans('orbscope.currency')}}">
                                                <option></option>
                                                @foreach($curen as $type)
                                                    <option value="{{$type->id}}">{{$type->symbol}} {{$type->name}} {{$type->symbol}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="date">{{trans('orbscope.date')}}<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-10">
                                            {!! Form::text('date',old('date'),['class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd','placeholder'=>trans('orbscope.date')]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.representor_list')}} </label>
                                        <div class="col-md-10">
                                            <select class="form-control select2" name="representor_id" id="representor_id" data-placeholder="{{trans('orbscope.representor_list')}}">
                                                <option></option>
                                                @foreach($rep as $type)
                                                    <option value="{{$type->id}}">{{VarByLang($type->name,GetLanguage())}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="agentType">{{trans('orbscope.invoice_type')}} </label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="invoice_type"  data-placeholder="{{trans('orbscope.invoice_type')}}">
                                        <option></option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{VarByLang($type->name,GetLanguage())}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="date">{{trans('orbscope.note')}}</label>
                                    <div class="col-md-10">
                                        {!! Form::textarea('notes',old('notes'),['class'=>'form-control','placeholder'=>trans('orbscope.note')]) !!}
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="form-group" id="upload">
                                <label class="col-md-2 control-label" for="pdf">{{trans('orbscope.files')}} </label>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" name="pdf[]" id="multiUp"  multiple>
                                </div>
                            </div>

                        </div>
                        <div class="clear-fix"></div>

                        <div class="form-group">



                                <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                    <tr role="row" class="heading">
                                        <th  width="20%"> {{trans('orbscope.down_payment')}} </th>
                                        <th > {{trans('orbscope.due_date')}} </th>
                                        <th > {{trans('orbscope.recived_date')}} </th>
                                        <th > {{trans('orbscope.RV')}} </th>
                                    </tr>
                                <tr role="row" class="filter">

                                    <td>
                                        <input type="number" step="any" class="form-control form-filter input-sm"  name="down_payment">
                                    </td>

                                    <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                <input type="text"   class="form-control  form-filter input-sm"  readonly name="due_date" >
                                                <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                            </div>



                                    </td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input type="text"   class="form-control  form-filter input-sm"  readonly name="recived_date" >
                                            <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                        </div>
                                    </td>

                                    <td>
                                        <input type="text"   class="form-control form-filter input-sm"  name="RV"> </td>

                                </tr>
                                </table>





                            </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn blue">{{trans('orbscope.add')}} {{trans('orbscope.invoice')}}</button>
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
