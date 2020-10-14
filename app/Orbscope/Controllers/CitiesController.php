<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\City;
use App\Orbscope\Models\Country;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CitiesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class CitiesController extends Controller
{

    use Authorizable;

    /**
     * @param CitiesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.cities.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.cities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.cities.create',['title'=> trans('orbscope.add').' '.trans('orbscope.cities')]);
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
            $city = new City;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);

            $city->name           = $names;
            $city->status         = $request->input('status');


            $city->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'cities',
                    'route'  =>LogRoute('cities'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$city->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/cities');

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
        $cities = City::find($id);
        return view('admin.cities.show',['show'=>$cities,'title'=>trans('orbscope.show').' '.trans('orbscope.cities').' : '.VarByLang($cities->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::find($id);
        return view('admin.cities.edit',['edit'=>$cities,'title'=>trans('orbscope.edit').' '.trans('orbscope.cities').' : '.VarByLang($cities->name,GetLanguage())]);
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
            $city = City::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);

            $city->name           = $names;
            $city->name           = $names;
            $city->status         = $request->input('status');
            Logs::SaveLog(
                [
                    'action' =>LogAction('edit',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'edit',
                    'table'  =>'cities',
                    'route'  =>LogRoute('cities'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$city->id ,
                ]
            );

            $city->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/cities');

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
        $cities = City::find($id);

        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($cities->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'cities',
            'route'  =>LogRoute('cities'),
            'data'   =>'log.delete_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$cities->id ,
        ]);
        $cities->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/cities');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'cities',
                    'route'  =>LogRoute('cities'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            City::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/cities');
        }
        else {
            $cities = City::find($data);
            $cities->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'cities',
                'route'  =>LogRoute('cities'),
                'data'   =>'log.delete_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/cities');
        }
    }












}
