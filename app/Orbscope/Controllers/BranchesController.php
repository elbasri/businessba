<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\City;
use App\Orbscope\Models\Country;
use App\Orbscope\Models\Branch;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\BranchesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class BranchesController extends Controller
{
    /**
     * @param BranchesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(BranchesDataTable $dataTable)
    {
        return $dataTable->render('admin.branches.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.branches')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {

        return view('admin.branches.create',['title'=> trans('orbscope.add').' '.trans('orbscope.branches')]);
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
            $branches = new Branch;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $branches->name             =$names;
            $branches->status            = $request->input('status');


            $branches->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'branches',
                    'route'  =>LogRoute('branches'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$branches->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/branches');

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
        $branches = Branch::find($id);
        return view('admin.branches.edit',['edit'=>$branches,'title'=>trans('orbscope.edit').' '.trans('orbscope.branches').' : '.VarByLang($branches->name,GetLanguage())]);
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
            $branches = Branch::find($id);

            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $branches->name             =$names;
            $branches->status            = $request->input('status');
            $branches->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'edit',
                    'table'  =>'branches',
                    'route'  =>LogRoute('branches'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$branches->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/branches');

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
        $branches = Branch::find($id);
        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($branches->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'branches',
            'route'  =>LogRoute('branches'),
            'data'   =>'log.delete_record'.' | '.'orbscope.branches'.' | '.' log.record_number '.' | '.$branches->id ,
        ]);
        $branches->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/branches');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            Branch::destroy($data);
            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'branches',
                    'route'  =>LogRoute('branches'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.branches'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/branches');
        }
        else {
            $branches = Branch::find($data);
            $branches->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'branches',
                'route'  =>LogRoute('branches'),
                'data'   =>'log.delete_record'.' | '.'orbscope.branches'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/branches');
        }
    }





}
