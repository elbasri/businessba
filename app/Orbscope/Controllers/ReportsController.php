<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\ReportCustomerDatatable;
use App\Orbscope\DataTables\ReportInvoicesDatatable;
use App\Orbscope\Models\Customer;
use App\Orbscope\Models\CustomerType;
use App\Orbscope\Models\Employee;
use App\Orbscope\Models\Invoice;
use App\Orbscope\Models\InvoiceSale;
use App\Orbscope\Models\InvoiceSale_product;
use App\Orbscope\Models\Purchases_product;
use App\Orbscope\Models\PurchasesInvoice;
use App\Orbscope\Models\Represent_list;
use App\Orbscope\Models\Store;
use App\Orbscope\Models\Shop;
use App\Orbscope\Models\City;
use App\Orbscope\Models\State;
use App\Orbscope\Models\Service;
use App\Orbscope\Models\Project;
use App\Orbscope\Models\Category;
use App\Orbscope\Models\SubCategory;
use App\Orbscope\Models\Brand;
use App\Orbscope\Models\Color;
use App\Orbscope\Models\Level;
use App\Orbscope\Models\Product;
use App\Orbscope\Models\Order;
use App\User;
use App\Orbscope\Models\supplier as Supplier;
use App\Orbscope\DataTables\ReportProductsDatatable;
use App\Orbscope\DataTables\ReportOrdersDatatable;
use Validator;
use Illuminate\Http\Request;

use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;

class ReportsController extends Controller
{



    public function customer_index()
    {
        $clients = Customer::where('soft_delete','no')->get();
        $types = CustomerType::where('soft_delete','no')->get();
        $empolyee = Employee::where('soft_delete','no')->get();
        $city=City::where('soft_delete','no')->get();

        return view('admin.reports.customer.index', [
            'title' => trans('orbscope.reports'). ' ' . trans('orbscope.Customers') ,
            'clients' => $clients,
            'types' => $types,
            'empolyee' => $empolyee,
            'city' => $city,
        ]);
    }

    public function customer_show(ReportCustomerDatatable $dataTable,Request $request) {


        $count = Customer::where(function($q){
            if(request()->has('type_id') && request('type_id')!= null) {

                return $q->where('customers.type_id',request()->input('type_id'));
            }
        });

        $count->where(function($q){
            if(request()->has('agent_id') && request('agent_id')!= null) {
                return $q->where('customers.employee_id',request()->input('agent_id'));
            }
        });
        $count->where(function($q){

            if(request()->has('city_id') && request('city_id')!= null) {

                return $q->where('customers.city_id',request()->input('city_id'));
            }
        });
        $count->where(function ($q) {
            if (request()->has('date_from') && request('date_from') != null && request('date_to')== null ) {
                $q->where('customers.created_at', '>=', request()->input('date_from'));
            }
            if (request()->has('date_to') && request('date_to') != null && request('date_from')== null ) {
                $q->where('customers.created_at', '<=', request()->input('created_at'));
            }
            if (request('date_to') != null && request('date_from')!= null ) {
                $q->whereBetween('customers.created_at', [request()->input('date_from'), request()->input('date_to')]);
            }
        });




        return $dataTable->render('admin.reports.customer.show',[
            'title' => trans('orbscope.report').' '.trans('orbscope.Customers'),
            'count' => $count->count(),
        ]);

    }

    public function customer_report(ReportInvoicesDatatable $dataTable,Request $request){
        $count=count($request->clients);

        if($count==1){
          $customer=Customer::find($request->clients[0]);
            $invoices=  Invoice::whereIn('customer_id',$request->clients)->where('softing_delete','no')->get();

            return view('admin.reports.all_invoices',compact('invoices','customer'));

        }else{
            $invoices=  Invoice::whereIn('customer_id',$request->clients)->where('softing_delete','no')->get();
            $count=$invoices->count();
            return $dataTable->render('admin.reports.customer.invoices',[
                'title' => trans('orbscope.report').' '.trans('orbscope.Customers'),
                'count' => $count,
            ]);
        }

    }




}
