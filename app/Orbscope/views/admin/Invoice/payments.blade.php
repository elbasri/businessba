@extends(AdminCore())
@section('content')
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin/Invoice')}}">{{trans('orbscope.invoices')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{$title}}</span>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!---
           <div class="note note-danger">
             --------------comment or alert--
            </div>
            -->
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{$title}}</span>
                    </div>
                    <div class="actions">

                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="{{url('admin/Invoice')}}" >
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> {{trans('orbscope.all')}} {{trans('orbscope.invoices')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th  width="20%"> {{trans('orbscope.amount_money')}} </th>
                                <th > {{trans('orbscope.due_date')}} </th>
                                <th > {{trans('orbscope.recived_date')}} </th>
                                <th > {{trans('orbscope.RV')}} </th>
                                <th > {{trans('orbscope.update')}} </th>
                            </tr>
                            @if($invoice->amount > $sum)
                            <form action="{{url('admin/add_payments/'.$invoice->id)}}" method="post">
                                {{ csrf_field() }}
                                <tr role="row" class="filter">

                                    <td>
                                        <input type="number" step="any" class="form-control form-filter input-sm" max="{{$invoice->amount - $sum}}"  name="down_payment">
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
                                    <td>
                                        <div class="margin-bottom-5">
                                            <button type="submit" class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                <i class="fa fa-plus"></i> {{trans('orbscope.add')}}</button>
                                        </div>
                                    </td>


                                </tr>
                            </form>
                            @endif

                            <form  name="update_salary" action="{{url('admin/payments/edit')}}" method="post">

                                {{ csrf_field() }}

                                @foreach($payments as $p)
                                <tr role="row" class="filter">


                                    <td>
                                        <input type="hidden" name="pay_id[]" value="{{$p->id}}">
                                        <input type="number" step="any" value="{{$p->amount}}" class="form-control form-filter input-sm" max="{{$invoice->amount - $sum}}"  name="down_payment[]">
                                    </td>

                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input type="text"  value="{{$p->due_date}}"  class="form-control   form-filter input-sm"  readonly name="due_date[]" >
                                            <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                        </div>



                                    </td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input type="text" value="{{$p->receive_date}}"   class="form-control  form-filter input-sm"  readonly name="recived_date[]" >
                                            <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                        </div>
                                    </td>

                                    <td>
                                        <input type="text" value="{{$p->RV}}"   class="form-control form-filter input-sm"  name="RV[]"> </td>
                                    <td>
                                        <div class="margin-bottom-5">
                                            <button type="submit" class="btn btn-sm yellow btn-outline filter-submit margin-bottom">
                                                 {{trans('orbscope.update')}}</button>
                                        </div>
                                    </td>


                                </tr>
                                @endforeach
                            </form>

                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                    <div class="well"> Invoice Log </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{trans('orbscope.agent')}}</th>
                            <th scope="col">{{trans('orbscope.action')}}</th>
                            <th scope="col">{{trans('orbscope.new_value')}}</th>
                            <th scope="col">{{trans('orbscope.old_value')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($invoice->logs->where('type','payment') as $l)
                            <th scope="row">1</th>
                            <td>{{@$l->agent->name}}</td>
                            <td>{{$l->action}}</td>
                            <td>{{$l->new_value}}</td>
                            <td>{{$l->old_value}}</td>
                           @endforeach
                        </tr>
                        <tr>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>


@endsection

