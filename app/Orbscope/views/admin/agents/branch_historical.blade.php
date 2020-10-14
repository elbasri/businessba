@extends(AdminCore())
@section('content')
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin/agents')}}">{{trans('orbscope.agents')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/agents/'.$agent->id.'/edit')}}">{{trans('orbscope.edit')}} {{trans('orbscope.agent')}}</a>
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
                </div>
                <div class="portlet-body">
                    @include('admin.agents.menu')

                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="10%"> # </th>
                                <th width="30%"> {{trans('orbscope.branch')}} </th>
                                <th width="30%"> {{trans('orbscope.date')}} </th>
                                <th width="30%">  {{trans('orbscope.update')}} </th>
                            </tr>
                            <form action="{{url('admin/addBH_historical/'.$agent->id)}}" method="post">
                                {{ csrf_field() }}
                                <tr role="row" class="filter">
                                    <td>

                                    </td>
                                    <td>
                                    <select name="branch_id" required class="form-control select2">
                                        <option value=""></option>
                                        @foreach($branchs as $b)
                                        <option value="{{$b->id}}">{{VarByLang($b->name,GetLanguage())}}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input type="text"  class="form-control  form-filter input-sm" required readonly name="date" >
                                            <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="margin-bottom-5">
                                            <button type="submit" class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                <i class="fa fa-plus"></i> {{trans('orbscope.add')}}</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>

                            <form  name="update_salary" action="{{url('admin/branch_historical')}}" method="post">

                                {{ csrf_field() }}
                                @foreach(@$agent->branchHistoric as $k=>$h)
                                    <tr role="row" >
                                        <input type="hidden" name="uplode_id[]" value="{{$h->id}}">
                                        <td>
                                        {{$k+1}}
                                        </td>
                                        <td>
                                            <select name="branch_id[]" required class="form-control select2">
                                                <option value=""></option>
                                                @foreach($branchs as $b)
                                                    <option value="{{$b->id}}" {{$h->branch_id ==$b->id?'selected':''}}>{{VarByLang($b->name,GetLanguage())}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                <input type="text" value="{{$h->date}}"  class="form-control  form-filter input-sm" required readonly name="date[]" >
                                                <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                            </div>
                                        </td>

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
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>


@endsection

