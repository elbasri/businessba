<script>
    $(document).ready(function () {
        var search = $("#search_menu").quicksearch("li");
    });
</script>
<!-- BEGIN SIDEBAR -->

<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">



        <div style="margin: 10px;padding: 0px" class="form-group form-md-line-input has-info sidebar-search-wrapper">
            <div class="input-group">
                <input type="text" class="form-control" id="search_menu" placeholder="{{trans('orbscope.search_menu')}}">
                <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="nav-item start {{ActiveAdminMenu('/')}}">
                <a href="{{url(AdminPath())}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{trans('orbscope.dashboard')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            @if (auth()->user()->can('Settings'))
                <li class="heading">
                    <h3 class="uppercase">{{trans('log.settings')}}</h3>
                </li>

                <li class="nav-item {{ActiveAdminMenu('settings')}}">
                    <a href="{{url(AdminPath().'/settings')}}" class="nav-link nav-toggle">
                        <i class="fa fa-cog"></i>
                        <span class="title">{{trans('log.settings')}}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endif





            @if (auth()->user()->can('Add Agents') || auth()->user()->can('Edit Agents') || auth()->user()->can('Show Agents') || auth()->user()->can('Delete Agents'))

                <li class="heading">
                    <h3 class="uppercase">{{trans('orbscope.HR')}}</h3>
                </li>

                <li class="nav-item {{ ActiveAdminMenu('agents') }} {{url('admin/employees/salarys')==url()->current()?'active open':''}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-people"></i>
                        <span class="title">{{trans('orbscope.agents')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('agents') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Agents'))
                            <li class="nav-item {{ActiveAdminLink('agents.create')}}">
                                <a href="{{url(AdminUrl('agents/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.agents')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Agents'))
                            <li class="nav-item  {{ActiveAdminLink('agents.index')}}">
                                <a href="{{url(AdminUrl('agents'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.agents')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Salary'))
                            <li class="nav-item  {{url('admin/employees/salarys')==url()->current()?'active open':''}}">
                                <a href="{{url(AdminUrl('employees/salarys'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.salarys')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add Cities') || auth()->user()->can('Edit Cities') || auth()->user()->can('Show Cities') || auth()->user()->can('Delete Cities'))
                <li class="nav-item {{ ActiveAdminMenu('cities') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-direction"></i>
                        <span class="title">{{trans('orbscope.cities')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('cities') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Cities'))
                            <li class="nav-item {{ActiveAdminLink('cities.create')}}">
                                <a href="{{url(AdminUrl('cities/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.cities')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Cities'))
                            <li class="nav-item  {{ActiveAdminLink('cities.index')}}">
                                <a href="{{url(AdminUrl('cities'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.cities')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add Department') || auth()->user()->can('Edit Department') || auth()->user()->can('Show Department') || auth()->user()->can('Delete Department'))
                <li class="nav-item {{ ActiveAdminMenu('department') }}">
                    <a href="javascript:" class="nav-link nav-toggle">
                        <i class="fa fa-server"></i>
                        <span class="title">{{trans('orbscope.departments')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('department') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Department'))
                            <li class="nav-item {{ActiveAdminLink('department.create')}}">
                                <a href="{{url(AdminUrl('department/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.department')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Department'))
                            <li class="nav-item  {{ActiveAdminLink('department.index')}}">
                                <a href="{{url(AdminUrl('department'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.departments')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add Branches') || auth()->user()->can('Edit Branches') || auth()->user()->can('Show Branches') || auth()->user()->can('Delete Branches'))
                <li class="nav-item {{ ActiveAdminMenu('branches') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-location-pin"></i>
                        <span class="title">{{trans('orbscope.branches')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('branches') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Branches'))
                            <li class="nav-item {{ActiveAdminLink('branches.create')}}">
                                <a href="{{url(AdminUrl('branches/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.branches')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Branches'))
                            <li class="nav-item  {{ActiveAdminLink('branches.index')}}">
                                <a href="{{url(AdminUrl('branches'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.branches')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add Position') || auth()->user()->can('Edit Position') || auth()->user()->can('Show Position') || auth()->user()->can('Delete Position'))
                <li class="nav-item {{ ActiveAdminMenu('position') }}">
                    <a href="javascript:" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">{{trans('orbscope.positions')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('position') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Position'))
                            <li class="nav-item {{ActiveAdminLink('position.create')}}">
                                <a href="{{url(AdminUrl('position/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.position')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Position'))
                            <li class="nav-item  {{ActiveAdminLink('position.index')}}">
                                <a href="{{url(AdminUrl('position'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.positions')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif






            @if (auth()->user()->can('Add Customer') || auth()->user()->can('Edit Customer') || auth()->user()->can('Show Customer') || auth()->user()->can('Delete Customer'))
                <li class="heading">
                    <h3 class="uppercase">{{trans('orbscope.Accounting')}}</h3>
                </li>
                <li class="nav-item {{ ActiveAdminMenu('Customer') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-people"></i>
                        <span class="title">{{trans('orbscope.Customers')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('Customer') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Customer'))
                            <li class="nav-item {{ActiveAdminLink('Customer.create')}}">
                                <a href="{{url(AdminUrl('Customer/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.Customer')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Customer'))
                            <li class="nav-item  {{ActiveAdminLink('Customer.index')}}">
                                <a href="{{url(AdminUrl('Customer'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.Customers')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add CystomerType') || auth()->user()->can('Edit CystomerType') || auth()->user()->can('Show CystomerType') || auth()->user()->can('Delete CystomerType'))
                <li class="nav-item {{ ActiveAdminMenu('CystomerType') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-people"></i>
                        <span class="title">{{trans('orbscope.customer_types')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('customer_type') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add CystomerType'))
                            <li class="nav-item {{ActiveAdminLink('customer_type.create')}}">
                                <a href="{{url(AdminUrl('CystomerType/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.customer_type')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show CystomerType'))
                            <li class="nav-item  {{ActiveAdminLink('CystomerType.index')}}">
                                <a href="{{url(AdminUrl('CystomerType'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.customer_types')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add Representor_list') || auth()->user()->can('Edit Representor_list') || auth()->user()->can('Show Representor_list') || auth()->user()->can('Delete Representor_list'))
                <li class="nav-item {{ ActiveAdminMenu('Representor_list') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-people"></i>
                        <span class="title">{{trans('orbscope.representors_lists')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('Representor_list') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Representor_list'))
                            <li class="nav-item {{ActiveAdminLink('Representor_list.create')}}">
                                <a href="{{url(AdminUrl('Representor_list/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.representor_list')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Representor_list'))
                            <li class="nav-item  {{ActiveAdminLink('Representor_list.index')}}">
                                <a href="{{url(AdminUrl('Representor_list'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.representors_lists')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif



            @if (auth()->user()->can('Add Invoice') || auth()->user()->can('Edit Invoice') || auth()->user()->can('Show Invoice') || auth()->user()->can('Delete Invoice'))
                <li class="nav-item {{ ActiveAdminMenu('Invoice') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-file-text-o"></i>
                        <span class="title">{{trans('orbscope.invoices')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('Invoice') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Invoice'))
                            <li class="nav-item {{ActiveAdminLink('Invoice.create')}}">
                                <a href="{{url(AdminUrl('Invoice/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.invoice')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Invoice'))
                            <li class="nav-item  {{ActiveAdminLink('Invoice.index')}}">
                                <a href="{{url(AdminUrl('Invoice'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.invoices')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add InvoiceType') || auth()->user()->can('Edit InvoiceType') || auth()->user()->can('Show InvoiceType') || auth()->user()->can('Delete InvoiceType'))
                <li class="nav-item {{ ActiveAdminMenu('InvoiceType') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-file-text-o"></i>
                        <span class="title">{{trans('orbscope.invoice_types')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('InvoiceType') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add InvoiceType'))
                            <li class="nav-item {{ActiveAdminLink('InvoiceType.create')}}">
                                <a href="{{url(AdminUrl('InvoiceType/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.invoice_type')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show InvoiceType'))
                            <li class="nav-item  {{ActiveAdminLink('InvoiceType.index')}}">
                                <a href="{{url(AdminUrl('InvoiceType'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.invoice_types')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Add Currencies') || auth()->user()->can('Edit Currencies') || auth()->user()->can('Show Currencies') || auth()->user()->can('Delete Currencies'))

                <li class="nav-item {{ ActiveAdminMenu('currencies') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title">{{trans('orbscope.currencies')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('currencies') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Currencies'))
                            <li class="nav-item {{ActiveAdminLink('currencies.create')}}">
                                <a href="{{url(AdminUrl('currencies/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.currencies')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Currencies'))
                            <li class="nav-item  {{ActiveAdminLink('currencies.index')}}">
                                <a href="{{url(AdminUrl('currencies'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.currencies')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

      <!-------
            <li class="nav-item {{ ActiveAdminMenu('reports') }}">
                <a href="javascript:" class="nav-link nav-toggle">
                    <i class="icon-list"></i>
                    <span class="title">{{trans('orbscope.reports')}}</span>
                    <span class="arrow {{ ActiveAdminMenu('reports') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {{ActiveAdminMenu('report/customers')}}">
                        <a href="{{url(AdminUrl('report/customers'))}}" class="nav-link ">
                            <span class="title">{{trans('orbscope.Customers')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
------------------------->


        @if (auth()->user()->can('Add Users') || auth()->user()->can('Edit Users') || auth()->user()->can('Show Users'))
                <li class="nav-item {{ ActiveAdminMenu('users') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-people"></i>
                        <span class="title">{{trans('orbscope.users')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('users') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Users'))
                            <li class="nav-item {{ActiveAdminLink('users.create')}}">
                                <a href="{{url(AdminUrl('users/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.user')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Users'))
                            <li class="nav-item  {{ActiveAdminLink('users.index')}}">
                                <a href="{{url(AdminUrl('users'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.users')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif





            @if (auth()->user()->can('Add Roles') || auth()->user()->can('Edit Roles') || auth()->user()->can('Show Roles') || auth()->user()->can('Delete Roles'))
                <li class="heading">
                    <h3 class="uppercase">{{trans('orbscope.roles')}}</h3>
                </li>

                <li class="nav-item {{ ActiveAdminMenu('roles') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title">{{trans('orbscope.roles')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('roles') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (auth()->user()->can('Add Roles'))
                            <li class="nav-item {{ActiveAdminLink('roles.create')}}">
                                <a href="{{url(AdminUrl('roles/create'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.roles')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Show Roles'))
                            <li class="nav-item  {{ActiveAdminLink('roles.index')}}">
                                <a href="{{url(AdminUrl('roles'))}}" class="nav-link ">
                                    <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.roles')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


            <!-------
                <li class="nav-item {{ ActiveAdminMenu('permissions') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-globe-alt"></i>
                        <span class="title">{{trans('orbscope.permissions')}}</span>
                        <span class="arrow {{ ActiveAdminMenu('permissions') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ActiveAdminLink('permissions.create')}}">
                            <a href="{{url(AdminUrl('permissions/create'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.add')}} {{trans('orbscope.permissions')}}</span>
                            </a>
                        </li>
                        <li class="nav-item  {{ActiveAdminLink('permissions.index')}}">
                            <a href="{{url(AdminUrl('permissions'))}}" class="nav-link ">
                                <span class="title">{{trans('orbscope.show-all')}} {{trans('orbscope.permissions')}}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            ---->




            @if (auth()->user()->can('Logs'))
                <li class="nav-item {{ActiveAdminMenu('logs')}}">
                    <a href="{{url(AdminPath().'/logs')}}" class="nav-link nav-toggle">
                        <i class="icon-info"></i>
                        <span class="title">{{trans('log.logs')}}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endif






        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->



<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
