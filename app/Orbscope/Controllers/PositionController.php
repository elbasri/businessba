<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\City;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\Position;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\PositionDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class PositionController extends Controller
{
    /**
     * @param positionDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    use Authorizable;
    public function index(PositionDataTable $dataTable)
    {
        return $dataTable->render('admin.position.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.position')]);
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function create()
    {

        return view('admin.position.create',['title'=> trans('orbscope.add').' '.trans('orbscope.position')]);
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
            $position = new Position();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $position->name              = $names;
            $position->status            = $request->input('status');


            $position->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name')),
                    'type'   =>'add',
                    'table'  =>'position',
                    'route'  =>LogRoute('position'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$position->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/position');

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
        $position = Position::find($id);
        return view('admin.position.edit',['edit'=>$position,'title'=>trans('orbscope.edit').' '.trans('orbscope.position').' : '.VarByLang($position->name,GetLanguage())]);
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
            $position = Position::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $position->name              = $names;
            $position->status            = $request->input('status');
            $position->save();

            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$request->input('ar_name')),
                    'type'   =>'edit',
                    'table'  =>'position',
                    'route'  =>LogRoute('position'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$position->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/position');

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
        $position = Position::find($id);

        Logs::SaveLog([
            'action' =>LogAction('delete',$position->id),
            'type'   =>'delete',
            'table'  =>'position',
            'route'  =>LogRoute('position'),
            'data'   =>'log.delete_record'.' | '.'orbscope.position'.' | '.' log.record_number '.' | '.$position->id ,
        ]);
        $position->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/position');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            Position::destroy($data);
            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'position',
                    'route'  =>LogRoute('position'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.position'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/position');
        }
        else {
            $position = Position::find($data);
            $position->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'position',
                'route'  =>LogRoute('position'),
                'data'   =>'log.delete_record'.' | '.'orbscope.position'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/position');
        }
    }





}
