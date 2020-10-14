<?php

    // Get Admin Theme
    function AdminLayout()
    {
        if(auth()->user())
        {
            if(!empty(auth()->user()->admin_theme))
            {
                $theme = auth()->user()->admin_theme;
                return $theme;
            }
            else
            {
                $theme = GetSettings()->admin_theme;
                return $theme;
            }
        }
        else
        {
            $theme = GetSettings()->admin_theme;
            return $theme;
        }
    }

    // Get Current Admin Theme
    function AdminTheme()
    {
        $theme = 'admin.themes.'.AdminLayout();
        return $theme;
    }

    // Get Admin Header
    function AdminHeader()
    {
        return AdminTheme().'.layout.header';
    }

    // Get Admin Css
    function AdminCss()
    {
        return AdminTheme().'.layout.css';
    }

    // Get Admin Js
    function AdminJs()
    {
        return AdminTheme().'.layout.js';
    }

    // Get Admin Menu
    function AdminMenu()
    {
        return AdminTheme().'.layout.menu';
    }

    // Get Admin Footer
    function AdminFooter()
    {
        return AdminTheme().'.layout.footer';
    }

    // Get Admin Form
    function AdminForm()
    {
        return AdminTheme().'.layout.form';
    }

    // Get Admin Table
    function AdminTable()
    {
        return AdminTheme().'.layout.table';
    }

    // Get Admin Core
    function AdminCore()
    {
        return AdminTheme().'.layout.core';
    }

    // Get Admin Messages
    function AdminMessages()
    {
        return AdminTheme().'.layout.messages';
    }

    // Get Admin Get By ID
    function AdminGetByID()
    {
        return AdminTheme().'.layout.show';
    }

    // Get Admin Breadcrumbs
    function AdminBreadcrumb()
    {
        return AdminTheme().'.layout.breadcrumb';
    }

    // Get Admin SideBar
    function AdminSidebar()
    {
        return AdminTheme().'.layout.sidebar';
    }

    // Set Admin Url
    function AdminUrl($url)
    {
        return AdminPath().'/'.$url;
    }
