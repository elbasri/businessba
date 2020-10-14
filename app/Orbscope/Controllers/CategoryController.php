<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Shop;
use App\Orbscope\Models\SubCategory;
use Illuminate\Http\Request;
use App\Orbscope\Models\supplier;
use App\Orbscope\Models\Category;
use Validator;
use App\Orbscope\DataTables\CategoryDataTable;
use App\Orbscope\DataTables\CategorySub;
use App\Orbscope\DataTables\CategoryProduct;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;
use App\Authorizable;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.category')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.category.create',['title'=> trans('orbscope.add').' '.trans('orbscope.category')]);
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

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $country = new Category;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('ar_name'));
            $names = EncodeVar($name);

            $country->name             = $names;
            $country->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$country->id),
                    'type'   =>'add',
                    'table'  =>'categories',
                    'route'  =>LogRoute('category'),
                    'data'   =>'log.add_record'.' | '.'orbscope.categorys'.' | '.' log.record_number '.' | '.$country->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/category/');

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
        $category = Category::find($id);
        return view('admin.category.show',['show'=>$category,'title'=>trans('orbscope.show').' '.trans('orbscope.category').' : '.VarByLang($category->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Category::find($id);
        return view('admin.category.edit',['edit'=>$country,'title'=>trans('orbscope.edit').' '.trans('orbscope.category').' : '.VarByLang($country->name,GetLanguage()) ]);
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



        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $country = Category::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('ar_name'));
            $names = EncodeVar($name);

            $country->name           = $names;
            $country->save();
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/category/');

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
        $country = Category::find($id);
        $country->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$country->id),
            'type'   =>'delete',
            'table'  =>'category',
            'route'  =>LogRoute('category'),
            'data'   =>'log.delete_record'.' | '.'orbscope.category'.' | '.' log.record_number '.' | '.$country->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/category');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $country   = Category::find($record);
                @unlink('uploads/'.$country->image);

                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'category',
                    'route'  =>LogRoute('category'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.category'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Category::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/category');
        }
        else {
            $category = Category::find($data);
            @unlink('uploads/'.$category->image);
            $category->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'category',
                'route'  =>LogRoute('category'),
                'data'   =>'log.delete_record'.' | '.'orbscope.category'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/category');
        }
    }

    public function cat_ajax(Request $request){

        $data=SubCategory::where('cat_id',$request->cat)->get();
        return view('admin.sub_category.cats',['data'=>$data]);
    }






}
