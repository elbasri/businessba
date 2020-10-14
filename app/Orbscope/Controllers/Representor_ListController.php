<?php

namespace App\Orbscope\Controllers;


use App\Orbscope\DataTables\RepresentListDataTable;
use App\Orbscope\Models\Employee;
use App\Orbscope\Models\Represent_list;
use App\Orbscope\Models\Representor_Detail;
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
class Representor_ListController extends Controller
{
    /**
     * @param representor_listDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(RepresentListDataTable $dataTable)
    {
        return $dataTable->render('admin.representor_list.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.representors_lists')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {

        return view('admin.representor_list.create',['title'=> trans('orbscope.add').' '.trans('orbscope.representor_list')]);
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
            $representor_list = new Represent_list();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $representor_list->name              = $names;
            $representor_list->status            = $request->input('status');
            $representor_list->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'representor_list',
                    'route'  =>LogRoute('representor_list'),
                    'data'   =>'log.add_record'.' | '.'orbscope.representor_list'.' | '.' log.record_number '.' | '.$representor_list->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/Representor_list');

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
        $representor_list = Represent_list::find($id);
        return view('admin.representor_list.edit',['edit'=>$representor_list,'title'=>trans('orbscope.edit').' '.trans('orbscope.representor_list').' : '.VarByLang($representor_list->name,GetLanguage())]);
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
            $representor_list = Represent_list::find($id);

            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $representor_list->name              = $names;
            $representor_list->status            = $request->input('status');
            $representor_list->save();


            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'edit',
                    'table'  =>'representor_list',
                    'route'  =>LogRoute('representor_list'),
                    'data'   =>'log.add_record'.' | '.'orbscope.representor_list'.' | '.' log.record_number '.' | '.$representor_list->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/Representor_list');

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
        $representor_list = Represent_list::find($id);
        $representor_list->soft_delete ='yes';
        $representor_list->save();
        Logs::SaveLog([
            'action' =>LogAction('delete',$representor_list->id),
            'type'   =>'delete',
            'table'  =>'representor_list',
            'route'  =>LogRoute('representor_list'),
            'data'   =>'log.delete_record'.' | '.'orbscope.representor_list'.' | '.' log.record_number '.' | '.$representor_list->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/Representor_list');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $k=>$record){
                $re=Represent_list::find($record[$k]);
                $re->soft_delete='yes';
                $re->save();

                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'representor_list',
                    'route'  =>LogRoute('representor_list'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.representor_list'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/Representor_list');
        }
        else {
            $representor_list = Represent_list::find($data);
            $representor_list->soft_delete='yes';
            $representor_list->save();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'representor_list',
                'route'  =>LogRoute('representor_list'),
                'data'   =>'log.delete_record'.' | '.'orbscope.representor_list'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/Representor_list');
        }
    }

    public function Representor_Details($id){
        $list = Represent_list::find($id);
        $detail=Representor_Detail::where('represent_id',$id)->OrderBy('created_at','desc')->get();
        $employes=Employee::where('status','active')->where('soft_delete','no')->get();

        return view('admin.representor_list.details',compact('list','detail','employes'),['title'=>trans('orbscope.representor_list').' '.VarByLang($list->name,GetLanguage())]);


    }

    public function add_Representor_Details($id,Request $request){

        $rules = [
            'employee_id'          => 'required',
            'sales_percent'          => 'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'employee_id'        =>trans('orbscope.agent'),
            'sales_percent'        =>trans('orbscope.sales_percent'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $new=new Representor_Detail();
            $new->represent_id=$id;
            $new->employee_id=$request->employee_id;
            $new->sales_percent=$request->sales_percent;
            $new->service_percent=$request->service_percent;
            $new->spare_part_percent=$request->spare_part_percent;
            if($request->type=='teamleader'){
                $new->team_leader=1;
            }elseif ($request->type=='managerleader'){

                $new->manager_leader=1;
            }
          $new->save();
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();

        }
    }

    public function update_Representor_Details(Request $request){
        foreach ($request->details_id as $k=>$v){
            $salary =Representor_Detail::find($request->details_id[$k]);
            $salary->employee_id =$request->employee_id[$k];
            $salary->sales_percent =$request->sales_percent[$k];
            $salary->service_percent =$request->service_percent[$k];
            $salary->spare_part_percent =$request->spare_part_percent[$k];


            if(isset($request->type[$k])){

                if ($request->type[$k] =='teamleader'){
                    $salary->team_leader =1;
                    $salary->manager_leader =0;
                }elseif ($request->type[$k] =='managerleader'){
                    $salary->manager_leader =1;
                    $salary->team_leader =0;
                }
            }

            $salary->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }





}
