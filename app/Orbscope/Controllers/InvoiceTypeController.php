<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\City;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\InvoiceType;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\InvoiceTypeDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class InvoiceTypeController extends Controller
{
    /**
     * @param InvoiceTypeDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(InvoiceTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.InvoiceType.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.invoice_types')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {

        return view('admin.InvoiceType.create',['title'=> trans('orbscope.add').' '.trans('orbscope.invoice_type')]);
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
            $InvoiceType = new InvoiceType();

            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $InvoiceType->name              = $names;
            $InvoiceType->status            = $request->input('status');


            $InvoiceType->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'invoice_type',
                    'route'  =>LogRoute('InvoiceType'),
                    'data'   =>'log.add_record'.' | '.'orbscope.invoice_type'.' | '.' log.record_number '.' | '.$InvoiceType->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/InvoiceType');

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
        $InvoiceType = InvoiceType::find($id);
        return view('admin.InvoiceType.edit',['edit'=>$InvoiceType,'title'=>trans('orbscope.edit').' '.trans('orbscope.invoice_type').' : '.VarByLang($InvoiceType->name,GetLanguage())]);
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
            $InvoiceType = InvoiceType::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $InvoiceType->name              = $names;
            $InvoiceType->status            = $request->input('status');

            $InvoiceType->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'edit',
                    'table'  =>'invoice_type',
                    'route'  =>LogRoute('InvoiceType'),
                    'data'   =>'log.add_record'.' | '.'orbscope.invoice_type'.' | '.' log.record_number '.' | '.$InvoiceType->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/InvoiceType');

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

        $InvoiceType = InvoiceType::find($id);
        $InvoiceType->soft_delete='yes';
        $InvoiceType->save();

        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($InvoiceType->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'InvoiceType',
            'route'  =>LogRoute('InvoiceType'),
            'data'   =>'log.delete_record'.' | '.'orbscope.InvoiceType'.' | '.' log.record_number '.' | '.$InvoiceType->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/InvoiceType');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $k=>$record){
                $invoic=InvoiceType::find($record[$k]);
                $invoic->soft_delete='yes';
                $invoic->save();
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'InvoiceType',
                    'route'  =>LogRoute('InvoiceType'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.InvoiceType'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/InvoiceType');
        }
        else {
            $InvoiceType = InvoiceType::find($data);
            $InvoiceType->soft_delete='yes';
            $InvoiceType->save();

            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'InvoiceType',
                'route'  =>LogRoute('InvoiceType'),
                'data'   =>'log.delete_record'.' | '.'orbscope.InvoiceType'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/InvoiceType');
        }
    }





}
