<?php

    Route::get(GetSettings()->admin_path.'/lang/{lang?}','SettingsController@ChangeLanguage');
    Route::get(GetSettings()->admin_path.'/login','AdminController@Login');
    Route::post(GetSettings()->admin_path.'/login','AdminController@Login_Request');
    Route::get(GetSettings()->admin_path.'/forget-password','AdminController@Forget_Password');
    Route::get(GetSettings()->admin_path.'/logout','AdminController@Logout');

    // Define Route Group Of admin
    Route::group(['middleware'=>['admin','timeout'],'prefix'=>GetSettings()->admin_path],function(){
        Route::get('/', 'AdminController@Index')->name('adminhomepage');
        //Logs Routes
        Route::post('logs/multi_delete', 'LogsController@multi_delete');
        Route::get('logs/{id}/recover', 'LogsController@recover');
        Route::resource('logs','LogsController');
        // settings
        Route::get('settings','LogsController@settings_show');
        Route::get('/ghangepass','LogsController@ghange_pass');
        Route::get('/profile','LogsController@profile');
        Route::post('ghange_pass','LogsController@store_pass');
        Route::post('settings','LogsController@settings_update')->name('settings.edit');

        //customer_type
        Route::post('CystomerType/multi_delete', 'CustomerTypeController@multi_delete');
        Route::resource('CystomerType','CustomerTypeController');


        // Branches Routes
        Route::post('branches/multi_delete', 'BranchesController@multi_delete');
        Route::resource('branches','BranchesController');
       //department
        Route::post('department/multi_delete', 'DepartmentController@multi_delete');
        Route::resource('department','DepartmentController');
        //position
        Route::post('position/multi_delete', 'PositionController@multi_delete');
        Route::resource('position','PositionController');

        // cities
        Route::post('cities/multi_delete', 'CitiesController@multi_delete');
        Route::resource('cities','CitiesController');

       // Route::get('Customer/{id}/invoices', 'CustomerTypeController@invoices');
        Route::get('customer/{id}/files', 'CustomerController@files');
        Route::post('add_files/customer/{id}', 'CustomerController@add_files');
        Route::resource('Customer','CustomerController');
        Route::post('InvoiceType/multi_delete', 'InvoiceTypeController@multi_delete');
        Route::resource('InvoiceType','InvoiceTypeController');
        Route::post('Invoice/multi_delete', 'InvoiceController@multi_delete');
        Route::get('payments/{id}', 'InvoiceController@payments');
        Route::post('add_files/invoices/{id}', 'InvoiceController@add_files');
        Route::post('add_payments/{id}', 'InvoiceController@add_payments');
        Route::post('payments/edit', 'InvoiceController@update_payments');
        Route::get('invoices/{id}/files', 'InvoiceController@files');
        Route::get('customer/{id}/invoice', 'InvoiceController@customer_invoice');
        Route::resource('Invoice','InvoiceController');


        Route::resource('currencies','CurrenciesController');

        Route::post('Representor_list/multi_delete', 'Representor_listController@multi_delete');
        Route::get('Representor_Details/{id}', 'Representor_listController@Representor_Details');
        Route::post('add/Representor_Details/{id}', 'Representor_listController@add_Representor_Details');
        Route::post('update_Representor_Details', 'Representor_listController@update_Representor_Details');
        Route::resource('Representor_list','Representor_ListController');



        // Agents
        Route::post('agents/multi_delete', 'AgentsController@multi_delete');
        Route::post('add_salary/{id}', 'AgentsController@add_salary');
        Route::get('salary/{id}/files', 'AgentsController@salary_files');
        Route::post('add_files/salary/{id}', 'AgentsController@add_salary_files');
        Route::post('add_subtract/{id}', 'AgentsController@add_subtract');
        Route::post('update_salary', 'AgentsController@update_salary');
        Route::post('update_subtract', 'AgentsController@update_subtract');
        Route::get('employee/{id}/{status}', 'AgentsController@emloyee_status');
        Route::post('branch_historical', 'AgentsController@branch_uplode');
        Route::post('postion_historical', 'AgentsController@position_uplode');
        Route::post('depart_historical', 'AgentsController@depart_historical_update');
        Route::post('addBH_historical/{id}', 'AgentsController@addBH_historical');
        Route::post('addPostion_historical/{id}', 'AgentsController@addPostion_historical');
        Route::post('add_depart_historic/{id}', 'AgentsController@add_depart_historic');
        Route::get('postion_historical/{id}', 'AgentsController@postion_historical');
        Route::get('branch_historical/{id}', 'AgentsController@branch_historical');
        Route::get('depart_historical/{id}', 'AgentsController@depart_historical');
        Route::get('agent/{id}/vacations', 'AgentsController@vacations');
        Route::get('agent/{id}/stay', 'AgentsController@stay');
        Route::post('add_files/agent/{id}', 'AgentsController@add_files');
        Route::post('add_vications/{id}', 'AgentsController@add_vications');
        Route::post('add_stay/{id}', 'AgentsController@add_stay');
        Route::post('update/vacations', 'AgentsController@update_vacations');
        Route::post('update/stay', 'AgentsController@update_stay');
        Route::get('employees/salarys', 'AgentsController@salarys');
        Route::get('agent/{id}/salary', 'AgentsController@get_salary');
        Route::get('agent/{id}/salary', 'AgentsController@get_salary');
        Route::get('salary_pdf/{id}/{year}/{month}', 'AgentsController@get_pdf');
        Route::post('/depart_branch/search', 'AgentsController@depart_branch');
        Route::post('date_salarys/search', 'AgentsController@date_salarys');
        Route::get('agent/{id}/subtract', 'AgentsController@subtract');
        Route::get('agents/{id}/files', 'AgentsController@files');
        Route::resource('agents','AgentsController');

        Route::post('users/multi_delete', 'UsersController@multi_delete');
        Route::get('user/{id}/{status}', 'UsersController@user_status');
        Route::resource('users','UsersController');


         Route::get('report/customers', 'ReportsController@customer_index');
         Route::get('customer_report', 'ReportsController@customer_report')->name('customer_report');
         Route::get('report/customer/show','ReportsController@customer_show')->name('report.customer');

        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');

        Route::get('download_projects/employees/{id}', 'AgentsController@download');
        Route::get('download_customer/customer/{id}', 'CustomerController@download');
        Route::get('download_Invoice/invoices/{id}', 'InvoiceController@download');
        Route::get('download_salary/salary/{id}', 'AgentsController@download_salary');
    });
