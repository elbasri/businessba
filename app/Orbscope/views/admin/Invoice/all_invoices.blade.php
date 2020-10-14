
@extends(AdminCore())
@section('content')
    <style>
        @media print{
            .noprint{
                display:none;
            }
        }
        </style>

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('report/Invoice')}}">{{trans('orbscope.invoices')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{trans('orbscope.invoices')}}  {{$invoice->invoice_number}}</span>
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
                        <li>{{VarByLang(@$invoice->customer->name,GetLanguage())}} </li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <h3>{{trans('orbscope.city')}}:</h3>
                    <ul class="list-unstyled">
                        <li> {{@VarByLang(@$invoice->customer->city->name,GetLanguage())}} </li>

                    </ul>
                </div>
                <div class="col-xs-4 invoice-payment">
                    <h3>{{trans('orbscope.representor')}}:</h3>
                    <ul class="list-unstyled">
                        <li>
                            {{@VarByLang($invoice->customer->agent->name,GetLanguage())}} </li>
                    </ul>
                </div>
            </div>
            <br/>
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
                            <td> # </td>
                            <td> {{$invoice->invoice_number}} </td>
                            <td> {{$invoice->amount}} </td>
                            <td > {{$invoice->date}} </td>
                            <td> {{@$invoice->currency->name}} {{@$invoice->currency->symbol}} </td>


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
                        @foreach($invoice->payments as $n=>$pa)
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
                                    <strong>{{trans('orbscope.total')}} :</strong> {{$invoice->amount}} </li>
                                <li>
                                    <strong>{{trans('orbscope.paid')}}:</strong>  {{@$invoice->payments->sum('amount')}} </li>
                            </ul>

                        </div>
                    </div>
                </div>

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
        <br/>
        <br/>
        <div class="well noprint"> Invoice Log </div>
        <table class="table noprint">
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
                @foreach($invoice->logs as $l)
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


@endsection