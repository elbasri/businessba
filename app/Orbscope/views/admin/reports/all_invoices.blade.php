
@extends(AdminCore())
@section('content')


        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('report/customers')}}">{{trans('orbscope.reports')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{trans('orbscope.invoices')}} {{trans('orbscope.Customer')}} {{$customer->name}}</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="invoice">
            <div class="row invoice-logo">
                <div class="col-xs-6 invoice-logo-space">
                    <h1>{{VarByLang(GetSettings()->name,GetLanguage())}}</h1> </div>
                <div class="col-xs-6">
                    <p> {{date("Y M D")}}

                    </p>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-4">
                    <h3>{{trans('orbscope.Customer')}}:</h3>
                    <ul class="list-unstyled">
                        <li>{{$customer->name}} </li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <h3>{{trans('orbscope.city')}}:</h3>
                    <ul class="list-unstyled">
                        <li> {{@VarByLang(@$customer->city->name,GetLanguage())}} </li>

                    </ul>
                </div>
                <div class="col-xs-4 invoice-payment">
                    <h3>{{trans('orbscope.representor')}}:</h3>
                    <ul class="list-unstyled">
                        <li>
                            {{@$customer->agent->name}} </li>
                    </ul>
                </div>
            </div>
            <br/>
            @foreach($invoices as $k=>$in)
            <div class="row">
                <div class="col-xs-12">

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> {{trans('orbscope.code')}} </th>
                            <th class="hidden-xs"> {{trans('orbscope.amount_money')}} </th>
                            <th class="hidden-xs"> {{trans('orbscope.date')}} </th>
                            <th class="hidden-xs"> {{trans('orbscope.currency')}} </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> {{$k+1}} </td>
                            <td> {{$in->invoice_number}} </td>
                            <td> {{$in->amount}} </td>
                            <td > {{$in->date}} </td>
                            <td> {{@$in->currency->name}} </td>


                        </tr>

                        </tbody>
                    </table>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr style="background: antiquewhite;">
                            <th> # </th>
                            <th > {{trans('orbscope.due_date')}} </th>
                            <th > {{trans('orbscope.recived_date')}} </th>
                            <th > {{trans('orbscope.RV')}} </th>
                            <th > {{trans('orbscope.amount_money')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($in->payments as $n=>$pa)
                        <tr>
                            <td> {{$n+1}} </td>
                            <td> {{$pa->due_date}} </td>
                            <td > {{$pa->receive_date}} </td>
                            <td > {{$pa->RV}} </td>
                            <td > {{$pa->amount}} </td>

                        </tr>
                         @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="well">
                            <ul class="list-unstyled amounts">
                                <li>
                                    <strong>{{trans('orbscope.total')}} :</strong> {{$in->amount}} </li>
                                <li>
                                    <strong>{{trans('orbscope.paid')}}:</strong>  {{@$in->payments->sum('amount')}} </li>
                            </ul>

                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row">

                <div class="col-xs-8 invoice-block">

                    <br/>
                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                        <i class="fa fa-print"></i>
                    </a>
                </div>
            </div>
        </div>

    <!-- END CONTENT BODY -->



@endsection