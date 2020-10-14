<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Customer;
use App\Orbscope\Models\City;
use App\Orbscope\Models\CustomerType;
use App\Orbscope\Models\Employee;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CustomerDataTable;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class CustomerController extends Controller
{
    use Authorizable;
    /**
     * @param CustomerDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('admin.Customer.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.Customers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city=City::where('status','active')->get();
        $employee=Employee::where('status','active')->get();
        $cutype=CustomerType::where('status','active')->get();
        return view('admin.Customer.create',compact('city','cutype','employee'),['title'=> trans('orbscope.add').' '.trans('orbscope.Customer')]);
    }

    public function files($id){


        $show=Customer::find($id);



        return view('admin.Customer.show',compact('show'),['title'=>trans('orbscope.files').' '.trans('orbscope.Customer').' '.VarByLang($show->name,GetLanguage())]);
    }

    public function add_files(Request $request,$id){

        $agent=Customer::find($id);

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
                $uploadedImages[]     = Upload::uploadImages('customer', $img,'allowExtFiles','false');
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'city'        => 'required',
            'employee_id' => 'required',
            'type_id'     => 'required',
            'ar_name'    => 'required',
            'en_name'    => 'required',
            'code'        => 'required|unique:customers',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'city'      =>trans('orbscope.city'),
            'employee_id'   =>trans('orbscope.representor'),
            'code'   =>trans('orbscope.code'),
            'type_id'   =>trans('orbscope.customer_type'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $Customer                 = new Customer();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $Customer->name           = $names;
            $Customer->mobile          = $request->input('mobile');
            $Customer->phone          = $request->input('phone');
            $Customer->code          = $request->input('code');
            $Customer->city_id          = $request->input('city');
            $Customer->employee_id      = $request->input('employee_id');
            $Customer->type_id          = $request->input('type_id');
            $Customer->status          = $request->input('status');
            $Customer->save();


            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'Customer',
                    'route'  =>LogRoute('Customer'),
                    'data'   =>'log.add_record'.' | '.'orbscope.Customer'.' | '.' log.record_number '.' | '.$Customer->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/Customer');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return redirect('/admin/Customer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $agent = Customer::find($id);
        $city=City::where('status','active')->get();
        $employee=Employee::where('status','active')->get();
        $cutype=CustomerType::where('status','active')->get();
        if ($agent) {
            return view('admin.Customer.edit',compact('cutype','city','employee'),[
                'title'=> trans('orbscope.edit').' '.trans('orbscope.Customer'),
                'edit' => $agent,

            ]);
        }
    }


    public function user_status($id,$status){
        $user=User::find($id);
        $user->status=$status;
        $user->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $Customer = Customer::find($id);
        if ($Customer) {
            $rules = [
                'city'        => 'required',
                'employee_id' => 'required',
                'type_id'     => 'required',
                'ar_name'    => 'required',
                'en_name'    => 'required',
                'code'        => 'required|unique:customers,code,'.$id.',id',
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->SetAttributeNames([
                'ar_name'  =>trans('orbscope.ar-name'),
                'en_name'  =>trans('orbscope.en-name'),
                'city'      =>trans('orbscope.city'),
                'employee_id'   =>trans('orbscope.representor'),
                'code'   =>trans('orbscope.code'),
                'type_id'   =>trans('orbscope.customer_type'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $Customer->name           = $names;
            $Customer->mobile          = $request->input('mobile');
            $Customer->phone          = $request->input('phone');
            $Customer->code          = $request->input('code');
            $Customer->city_id          = $request->input('city');
            $Customer->employee_id      = $request->input('employee_id');
            $Customer->type_id          = $request->input('type_id');
            $Customer->status          = $request->input('status');
            $Customer->save();

            Logs::SaveLog([
                'action' =>LogAction('edit',$request->input('ar_name'),$request->input('en_name')),
                'type'   =>'edit',
                'table'  =>'Customer',
                'route'  =>LogRoute('Customer'),
                'data'   =>'log.add_record'.' | '.'orbscope.Customer'.' | '.' log.record_number '.' | '.$Customer->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/Customer');

        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //$Customer = User::find($id);
        $Customer = Customer::find($id);
        $Customer->soft_delete='yes';
        $Customer->save();
        //$Customer->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($Customer->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'Customer',
            'route'  =>LogRoute('Customer'),
            'data'   =>'log.delete_record'.' | '.'orbscope.Customer'.' | '.' log.record_number '.' | '.$Customer->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/Customer');
    }

    /*
    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'Customer',
                    'route'  =>LogRoute('Customer'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.Customer'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            User::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/Customer');
        }
        else {
            $Customer = User::find($data);
            $Customer->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'Customer',
                'route'  =>LogRoute('Customer'),
                'data'   =>'log.delete_record'.' | '.'orbscope.Customer'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/Customer');
        }
    }
    */

    public function download($id){


        $file_path = public_path('uploads').'/customer/'.$id;
        return response()->download($file_path);
    }




}
