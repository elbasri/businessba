@extends(AdminCore())
@section('content')
    <script src="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{url('orbscope/admin')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('orbscope/admin')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin/employees/salarys')}}">{{trans('orbscope.salarys')}}</a>
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
                        <div class="btn-group btn-group-devided" >
                            <a href="{{url('admin/agent/'.$emloye->id.'/salary')}}" class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm {{url()->current()==url('admin/agent/'.$emloye->id.'/salary')?'active':''}}">
                                {{trans('orbscope.salary')}}</a>
                            <a href="{{url('admin/agent/'.$emloye->id.'/subtract')}}" class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm {{url()->current()==url('admin/agent/'.$emloye->id.'/subtract')?'active':''}}">
                                <i class="fa fa-external-link" aria-hidden="true"></i>  {{trans('orbscope.subtract_added')}}</a>
                        </div>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="{{url('admin/employees/salarys')}}" >
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> {{trans('orbscope.back')}} </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">

                                        <span></span>
                                    </label>
                                </th>
                                <th width="20%"> {{trans('orbscope.name')}} </th>
                                <th width="10%"> {{trans('orbscope.amount_money')}} </th>
                                <th width="10%"> {{trans('orbscope.subtract')}} </th>
                                <th width="20%"> {{trans('orbscope.date')}} </th>
                                <th width="25%"> {{trans('orbscope.note')}} </th>
                                <th width="5%"> {{trans('orbscope.active')}} </th>
                                <th width="10%">  {{trans('orbscope.update')}} </th>
                            </tr>
                            <form action="{{url('admin/add_subtract/'.$emloye->id)}}" method="post">
                                {{ csrf_field() }}
                                <tr role="row" class="filter">
                                    <td>
                                        _</td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" required name="name"> </td>
                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control form-filter input-sm" required name="salary"> </td>
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox"  name="subtract" value="subtract"  >
                                            <span></span>
                                        </label>
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
                                        <input type="text" class="form-control form-filter input-sm" name="note" placeholder="" /> </td>



                                    <td>
                                        <div class="margin-bottom-5">
                                            <button type="submit" class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                <i class="fa fa-plus"></i> {{trans('orbscope.add')}}</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>

                            <form  name="update_salary" action="{{url('admin/update_subtract')}}" method="post">
                                @foreach($sub as $k=>$v)

                                    {{ csrf_field() }}
                                    <input type="hidden" name="sub_id[]" value="{{$v->id}}">
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>
                                            <input type="text" value="{{$v->name}}" class="form-control form-filter input-sm" required name="name[]"> </td>
                                        </td>
                                        <td>
                                            <input type="number" value="{{$v->amount}}" step="any" class="form-control form-filter input-sm" required name="salary[]"> </td>
                                        <td>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox"  {{$v->type=='sub'?'checked':''}}   name="subtract[]" value="subtract"  >
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                <input type="text" value="{{$v->date}}"  class="form-control  form-filter input-sm" required readonly name="date[]" >
                                                <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" value="{{$v->note}}" class="form-control form-filter input-sm" name="note[]" placeholder="" /> </td>


                                        <td><div class="margin-bottom-5">
                                                <button type="submit"  class="btn btn-sm yellow btn-outline filter-submit margin-bottom">
                                                    {{trans('orbscope.update')}}
                                                </button>
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

