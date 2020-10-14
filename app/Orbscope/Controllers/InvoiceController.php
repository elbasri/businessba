<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\CustomerInvoicesDataTables;
use App\Orbscope\Models\City;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\Currency;
use App\Orbscope\Models\Customer;
use App\Orbscope\Models\Invoice;
use App\Orbscope\Models\Invoice_Log;
use App\Orbscope\Models\InvoiceType;
use App\Orbscope\Models\Payment;
use App\Orbscope\Models\Represent_list;
use Illuminate\Validation\Rules\In;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\InvoiceDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class InvoiceController extends Controller
{
    /**
     * @param InvoiceDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('admin.Invoice.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.invoices')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {
        $rep=Represent_list::where('status','active')->where('soft_delete','no')->get();
        $types=InvoiceType::where('status','active')->where('soft_delete','no')->get();
        $curen=Currency::where('status','active')->where('soft_delete','no')->get();
        $cust=Customer::where('soft_delete','no')->get();
        return view('admin.Invoice.create',compact('cust','curen','types','rep'),['title'=> trans('orbscope.add').' '.trans('orbscope.invoice')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = [
            'invoice_number'        => 'required|unique:invoices',
            'customer_id'        => 'required',
            'invoice_type'        => 'required',
            'amount'        => 'required',
            'currency_id'        => 'required',
            'date'        => 'required',
            'representor_id'        => 'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'invoice_number'        =>trans('orbscope.code'),
            'customer_id'        =>trans('orbscope.Customer'),
            'amount'        =>trans('orbscope.amount_money'),
            'currency_id'        =>trans('orbscope.currency'),
            'invoice_type'        =>trans('orbscope.invoice_type'),
            'representor_id'        =>trans('orbscope.representor_list'),
            'date'        =>trans('orbscope.date'),


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $Invoice = new Invoice();

            $Invoice->invoice_number              = $request->input('invoice_number');
            $Invoice->date            = $request->input('date');
            $Invoice->customer_id            = $request->input('customer_id');
            $Invoice->amount            = $request->input('amount');
            $Invoice->invoice_type            = $request->input('invoice_type');
            $Invoice->currency_id	            = $request->input('currency_id');
            $Invoice->representor_id	            = $request->input('representor_id');
            $Invoice->notes	            = $request->input('notes');
            $files                      = $request->file('pdf');
            if(!empty($files ) && $files != ''){
                foreach ($files as $img){
                    $uploadedImages[]     = Upload::uploadImages('invoices', $img,'allowExtFiles','false');
                }
                if($uploadedImages == 'false'){
                    return back()->withInput();
                }else{
                    $tcl = implode('|', $uploadedImages);
                    $Invoice->files       = $tcl;
                }
            }
            $Invoice->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$Invoice->invoice_number),
                    'type'   =>'add',
                    'table'  =>'Invoice',
                    'route'  =>LogRoute('invoice'),
                    'data'   =>'log.add_record'.' | '.'orbscope.invoices'.' | '.' log.record_number '.' | '.$Invoice->id ,
                ]
            );

            $invoice_log=new Invoice_Log();
            $invoice_log->employee_id  =auth()->user()->id;
            $invoice_log->type       ='invoice';
            $invoice_log->invoice_id       =$Invoice->id;
            $invoice_log->action       ='add';
            $invoice_log->new_value     =$Invoice->amount;
            $invoice_log->save();

            if ($Invoice && !empty($request->down_payment)){
             $pay=new Payment();
             $pay->amount=$request->down_payment;
             $pay->RV=$request->RV;
             $pay->due_date=$request->due_date;
             $pay->receive_date=$request->recived_date;
             $pay->invoice_id  =$Invoice->id;
             $pay->save();
            }
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $invoice=Invoice::find($id);


        return view('admin.Invoice.all_invoices',compact('invoice'),['title'=>trans('orbscope.show').' '.trans('orbscope.invoice').' '.$invoice->invoice_number]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Invoice = Invoice::find($id);
        $rep=Represent_list::where('status','active')->where('soft_delete','no')->get();
        $types=InvoiceType::where('status','active')->where('soft_delete','no')->get();
        $curen=Currency::where('status','active')->where('soft_delete','no')->get();
        $customer=Customer::where('soft_delete','no')->get();
        return view('admin.Invoice.edit',compact('rep','types','curen','customer'),['edit'=>$Invoice,'title'=>trans('orbscope.edit').' '.trans('orbscope.invoice').' : '.$Invoice->name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'invoice_number'        => 'required',
            'customer_id'        => 'required',
            'invoice_type'        => 'required',
            'amount'        => 'required',
            'currency_id'        => 'required',
            'date'        => 'required',
            'representor_id'        => 'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'invoice_number'        =>trans('orbscope.code'),
            'customer_id'        =>trans('orbscope.Customer'),
            'amount'        =>trans('orbscope.amount_money'),
            'currency_id'        =>trans('orbscope.currency'),
            'invoice_type'        =>trans('orbscope.invoice_type'),
            'representor_id'        =>trans('orbscope.representor_list'),
            'date'        =>trans('orbscope.date'),


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {



            $Invoice = Invoice::find($id);

            $invoice_log=new Invoice_Log();
            $invoice_log->employee_id  =auth()->user()->id;
            $invoice_log->type       ='invoice';
            $invoice_log->action       ='edit';
            $invoice_log->invoice_id       =$Invoice->id;
            $invoice_log->old_value     =$Invoice->amount;
            $invoice_log->new_value     =$request->input('amount');
            $invoice_log->save();

            $Invoice->invoice_number              = $request->input('invoice_number');
            $Invoice->date            = $request->input('date');
            $Invoice->customer_id            = $request->input('customer_id');
            $Invoice->amount            = $request->input('amount');
            $Invoice->invoice_type            = $request->input('invoice_type');
            $Invoice->currency_id	            = $request->input('currency_id');
            $Invoice->representor_id	            = $request->input('representor_id');
            $Invoice->notes	            = $request->input('notes');
            $Invoice->save();

            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$Invoice->invoice_number),
                    'type'   =>'edit',
                    'table'  =>'Invoice',
                    'route'  =>LogRoute('invoice'),
                    'data'   =>'log.add_record'.' | '.'orbscope.invoices'.' | '.' log.record_number '.' | '.$Invoice->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/Invoice');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Invoice = Invoice::find($id);
        $Invoice->softing_delete='yes';
        $Invoice->save();

        Logs::SaveLog([
            'action' =>LogAction('delete',$Invoice->invoice_number),
            'type'   =>'delete',
            'table'  =>'Invoice',
            'route'  =>LogRoute('Invoice'),
            'data'   =>'log.delete_record'.' | '.'orbscope.Invoice'.' | '.' log.record_number '.' | '.$Invoice->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/Invoice');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $k=>$record){
                $invoic=Invoice::find($record[$k]);
                $invoic->softing_delete='yes';
                $invoic->save();
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'Invoice',
                    'route'  =>LogRoute('Invoice'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.Invoice'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/Invoice');
        }
        else {
            $Invoice = Invoice::find($data);
            $Invoice->softing_delete='yes';
            $Invoice->save();

            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'Invoice',
                'route'  =>LogRoute('Invoice'),
                'data'   =>'log.delete_record'.' | '.'orbscope.Invoice'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/Invoice');
        }
    }

    public function payments($id){
       $invoice=Invoice::find($id);



       $payments=Payment::where('invoice_id',$id)->OrderBy('receive_date','desc')->get();

       $sum=$payments->sum('amount');





       return view('admin.Invoice.payments',compact('invoice','sum','payments'),['title'=>trans('orbscope.payments').' '.trans('orbscope.invoice').' '.$invoice->invoice_number]);
    }

    public function add_payments(Request $request,$id){

        $rules = [
            'down_payment'        => 'required',
            'due_date'        => 'required',
            'recived_date'        => 'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'down_payment'        =>trans('orbscope.amount_money'),
            'due_date'        =>trans('orbscope.due_date'),
            'recived_date'        =>trans('orbscope.recived_date'),


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $new=new Payment();
            $new->amount  =$request->down_payment;
            $new->RV =$request->RV;
            $new->due_date =$request->due_date;
            $new->receive_date =$request->recived_date;
            $new->invoice_id =$id;



            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$new->id),
                    'type'   =>'add',
                    'table'  =>'payment',
                    'route'  =>LogRoute('payments'),
                    'data'   =>'log.add_record'.' | '.'orbscope.payments'.' | '.' log.record_number '.' | '.$new->id ,
                ]
            );
             $new->save();


            $invoice_log=new Invoice_Log();
            $invoice_log->employee_id  =auth()->user()->id;
            $invoice_log->type       ='payment';
            $invoice_log->invoice_id       =$id;
            $invoice_log->action       ='add';
            $invoice_log->new_value     =$new->amount;
            $invoice_log->save();

            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect()->back();
        }

    }

    public function update_payments(Request $request){

        $rules = [
            'down_payment'        => 'required',
            'due_date'        => 'required',
            'recived_date'        => 'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'down_payment'        =>trans('orbscope.amount_money'),
            'due_date'        =>trans('orbscope.due_date'),
            'recived_date'        =>trans('orbscope.recived_date'),


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            foreach ($request->pay_id as $k=>$v){
                $Payment =Payment::find($request->pay_id[$k]);
                $Payment->amount =$request->down_payment[$k];
                $Payment->RV =$request->RV[$k];
                $Payment->due_date =$request->due_date[$k];
                $Payment->receive_date =$request->recived_date[$k];
                $Payment->save();

            }
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();
        }
    }


    public function customer_invoice(CustomerInvoicesDataTables $dataTable,$id){

        $customer       = Customer::find($id);
        return $dataTable->LeadID($id)->render('admin.Customer.invoices',['title'=>trans('orbscope.show').' '.trans('orbscope.invoices').' : '.VarByLang($customer->name,GetLanguage())]);
    }

    public function files($id){


        $show=Invoice::find($id);



        return view('admin.Invoice.show',compact('show'),['title'=>trans('orbscope.files').' '.trans('orbscope.invoice').' '.$show->invoice_number]);
    }

    public function add_files(Request $request,$id){


        $agent=Invoice::find($id);

        $oldImages = $request->input('oldpdf');
        if ($request->has('oldpdf')) {
            $deletedImages = array_diff(explode('|',$agent->files),$oldImages);
        }else{
            $deletedImages = explode('|',$agent->files);
        }
        if (is_array($deletedImages)) {
            foreach ($deletedImages as $img) {
                @unlink('uploads/'.$img);
            }
        }
        if($request->hasFile('pdfs')){
            $pdfs = $request->file('pdfs');
            foreach ($pdfs as $img){
                $uploadedImages[]     = Upload::uploadImages('invoices', $img,'allowExtFiles','false');
            }
        }else{
            $uploadedImages = [];
        }
        if (is_array($oldImages)) {
            $allImages = array_merge($uploadedImages,$oldImages);
        }else{
            $allImages = $uploadedImages;
        }
        $project_imgs = implode('|', $allImages);
        if($uploadedImages == 'false'){
            return back()->withInput();
        }else{
            $agent->files       = $project_imgs;
        }
        $agent->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function download($id){


        $file_path = public_path('uploads').'/invoices/'.$id;
        return response()->download($file_path);
    }





}
