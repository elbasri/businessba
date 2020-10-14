@extends(AdminCore())
@section('content')
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin/Representor_list')}}">{{trans('orbscope.representors_lists')}}</a>
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
                            <a class="btn red btn-outline btn-circle" href="{{url('admin/Representor_list')}}" >
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> {{trans('orbscope.all')}} {{trans('orbscope.representors_lists')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container" style="overflow-x:auto;">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">

                                        <span></span>
                                    </label>
                                </th>
                                <!--
                                <th > {{trans('orbscope.street')}} </th>
                                -->
                                <th width="20%"> {{trans('orbscope.agent')}} </th>
                                <th > {{trans('orbscope.sales_percent')}} </th>
                                <th > {{trans('orbscope.service_percent')}} </th>
                                <th > {{trans('orbscope.spare_part_percent')}} </th>
                                <th >  {{trans('orbscope.teamleader')}} </th>
                                <th >  {{trans('orbscope.managerleader')}} </th>
                                <th >  {{trans('orbscope.update')}} </th>
                            </tr>
                            <form action="{{url('admin/add/Representor_Details/'.$list->id)}}" method="post">
                                {{ csrf_field() }}
                                <tr role="row" class="filter">

                                    <td>
                                        _
                                    </td>
                                <!--
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm"  name="street"> </td>
                                        -->

                                    <td>
                                        <select name="employee_id" required class="form-control form-filter">
                                            <option value=""></option>
                                            @foreach($employes as $em)
                                           <option value="{{$em->id}}">{{VarByLang($em->name,GetLanguage())}}</option>
                                           @endforeach
                                        </select>
                                         </td>
                                    <td>
                                        <input type="number" value="0"  step="any" class="form-control form-filter input-sm" required name="sales_percent"> </td>
                                    <td>

                                        <input type="number" value="0"  step="any" class="form-control form-filter input-sm"  name="service_percent"></td>
                                    <td>
                                        <input type="number" value="0"  step="any" class="form-control form-filter input-sm"  name="spare_part_percent">
                                    </td>
                                    <td>
                                        <input type="radio" id="huey" name="type" value="teamleader">
                                    </td>
                                    <td>
                                        <input type="radio" id="dewey" name="type" value="managerleader">
                                    </td>
                                    <td>
                                        <div class="margin-bottom-5">
                                            <button type="submit" class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                <i class="fa fa-plus"></i> {{trans('orbscope.add')}}</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>

                            <form  name="update_salary" action="{{url('admin/update_Representor_Details')}}" method="post">

                                 @foreach($detail as $k=>$t)
                                    {{ csrf_field() }}
                                    <tr role="row" class="filter">
                                        <input type="hidden" name="details_id[]" value="{{$t->id}}">

                                        <td>
                                           {{$k+1}}
                                        </td>
                                        <!--
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm"  name="street"> </td>
                                                -->

                                        <td>
                                            <select name="employee_id[]" required class="form-control form-filter">
                                                @foreach($employes as $em)
                                                    <option value=""></option>
                                                    <option value="{{$em->id}}" {{$t->employee_id==$em->id?'selected':''}}>{{VarByLang($em->name,GetLanguage())}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" value="{{$t->sales_percent}}"   step="any" class="form-control form-filter input-sm" required  name="sales_percent[]"> </td>
                                        <td>

                                            <input type="number" value="{{$t->service_percent}}"  step="any" class="form-control form-filter input-sm"  name="service_percent[]"></td>
                                        <td>
                                            <input type="number" value="{{$t->spare_part_percent}}"  step="any" class="form-control form-filter input-sm"  name="spare_part_percent[]">
                                        </td>
                                        <td>
                                            <input type="radio" id="huey" name="type[]" value="teamleader"  {{$t->team_leader==1?'checked':''}}>
                                        </td>
                                        <td>
                                            <input type="radio" id="dewey" name="type[]" value="managerleader"  {{$t->manager_leader==1?'checked':''}}>
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

