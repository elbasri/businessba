<!DOCTYPE html>
<!--[if IE 8]>
<html lang="{{GetLanguage()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{GetLanguage()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{GetLanguage()}}" dir="{{GetDirection()}}">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>@if(!empty($title)) {{$title}} || {{ @SettingsByLang('name',GetLanguage()) }}  @else {{ @SettingsByLang('name',GetLanguage()) }}  @endif</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="alweseemy Co." name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include(AdminCss())
    @include(AdminJs())

    @yield('css')
    @yield('js')


</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->

<div class="page-wrapper">
    <!-- BEGIN HEADER -->

<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">

        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/admin')}}">
                <h3>{{@SettingsByLang('name',GetLanguage())}}</h3> </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>


        <!-- BEGIN PAGE TOP -->
        <div class="page-top">

            <!-- BEGIN HEADER SEARCH BOX -->

            <!-- END HEADER SEARCH BOX -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>

            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <li class="separator hide"> </li>
                    <li>
                    @if(GetLanguage() == "ar")
                        <a style="font-weight: bold;" href="{{url(AdminPath().'/lang/en')}}">English</a>
                    @else
                        <a style="font-weight: bold;" href="{{url(AdminPath().'/lang/ar')}}">عربي</a>
                    @endif
                    </li>


                <!-- END INBOX DROPDOWN -->

                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{url('orbscope/admin')}}/assets/layouts/layout/img/avatar3_small.jpg" />
                            <span class="username username-hide-on-mobile"> {{auth()->user()->name}} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{url(AdminPath().'/profile')}}">
                                    <i class="icon-user"></i>{{trans('orbscope.profile')}} </a>
                            </li>
                            <li>
                                <a href="{{url(AdminPath().'/logout')}}">
                                    <i class="icon-key"></i>{{trans('orbscope.logout')}} </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="{{url(AdminPath().'/logout')}}" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>



                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->

        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->

<div class="page-container">

<!-- BEGIN SIDEBAR -->
