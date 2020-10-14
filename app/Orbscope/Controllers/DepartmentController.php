<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\DepartmentDataTable;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\Department;
use Validator;
use Illuminate\Http\Request;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class DepartmentController extends Controller
{
    /**
     * @param departmentDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(DepartmentDataTable $dataTable)
    {
        return $dataTable->render('admin.department.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.departments')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {

        return view('admin.department.create',['title'=> trans('orbscope.add').' '.trans('orbscope.department')]);
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
            $department = new Department();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $department->name              = $names;
            $department->status            = $request->input('status');


            $department->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'department',
                    'route'  =>LogRoute('department'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$department->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/department');

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
        $department = Department::find($id);
        return view('admin.department.edit',['edit'=>$department,'title'=>trans('orbscope.edit').' '.trans('orbscope.department').' : '.    VarByLang($department->name,GetLanguage())]);
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
            $department = Department::find($id);

            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $department->name              = $names;
            $department->status            = $request->input('status');
            $department->save();


            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'department',
                    'route'  =>LogRoute('department'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$department->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/department');

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
        $department = Department::find($id);

        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($department->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'department',
            'route'  =>LogRoute('department'),
            'data'   =>'log.delete_record'.' | '.'orbscope.department'.' | '.' log.record_number '.' | '.$department->id ,
        ]);
        $department->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/department');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            Department::destroy($data);
            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'department',
                    'route'  =>LogRoute('department'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.department'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/department');
        }
        else {
            $department = Department::find($data);
            $department->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'department',
                'route'  =>LogRoute('department'),
                'data'   =>'log.delete_record'.' | '.'orbscope.department'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/department');
        }
    }





}
