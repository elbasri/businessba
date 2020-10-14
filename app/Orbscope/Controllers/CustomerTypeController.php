<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\CustomerTypeDataTable;
use App\Orbscope\Models\City;
use App\Orbscope\Models\Country;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\CustomerType;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\customer_typeDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class CustomerTypeController extends Controller
{
    /**
     * @param customer_typeDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(CustomerTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.customer_type.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.customer_type')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {


        return view('admin.customer_type.create',['title'=> trans('orbscope.add').' '.trans('orbscope.customer_type')]);
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
            'ar_name'    => 'required',
            'en_name'    => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $customer_type = new CustomerType();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $customer_type->name              =$names;
            $customer_type->status            = $request->input('status');


            $customer_type->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'customer_type',
                    'route'  =>LogRoute('customer_type'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$customer_type->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/CystomerType');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer_type = CustomerType::find($id);
        return view('admin.customer_type.edit',['edit'=>$customer_type,'title'=>trans('orbscope.edit').' '.trans('orbscope.customer_type').' : '.VarByLang($customer_type->name,GetLanguage())]);
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
            'ar_name'    => 'required',
            'en_name'    => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $customer_type = CustomerType::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'),$request->input('en_name'));
            $names = json_encode($name);
            $customer_type->name              = $names;
            $customer_type->status            = $request->input('status');
            $customer_type->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$request->input('ar_name')),
                    'type'   =>'edit',
                    'table'  =>'customer_type',
                    'route'  =>LogRoute('customer_type'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$customer_type->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/CystomerType');

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
        $customer_type = CustomerType::find($id);

        Logs::SaveLog([
            'action' =>LogAction('delete',$customer_type->id),
            'type'   =>'delete',
            'table'  =>'customer_type',
            'route'  =>LogRoute('customer_type'),
            'data'   =>'log.delete_record'.' | '.'orbscope.customer_type'.' | '.' log.record_number '.' | '.$customer_type->id ,
        ]);
        $customer_type->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/CystomerType');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            CustomerType::destroy($data);
            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'customer_type',
                    'route'  =>LogRoute('customer_type'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.customer_type'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/CystomerType');
        }
        else {
            $customer_type = CustomerType::find($data);
            $customer_type->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'customer_type',
                'route'  =>LogRoute('customer_type'),
                'data'   =>'log.delete_record'.' | '.'orbscope.customer_type'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/CystomerType');
        }
    }





}
