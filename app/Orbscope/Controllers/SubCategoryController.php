<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\ServicesDataTable;
use App\Orbscope\Models\Category;
use App\Orbscope\Models\Shop;
use Illuminate\Http\Request;
use App\Orbscope\Models\Supplier;
use App\Orbscope\Models\SubCategory;
use Validator;
use App\Orbscope\DataTables\SubCategoryDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class SubcategoryController extends Controller
{

    public function index()
    {
    }

    public function show_all($id,SubCategoryDataTable $dataTable)
    {
        $sub=Category::find($id);
        return $dataTable->LeadID($id)->render('admin.sub_category.index',compact('sub'),['title' => trans('orbscope.show-all').' '.trans('orbscope.sub_categorys').' '.VarByLang($sub->name,'ar')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cat = Category::where('status','active')->get();
        return view('admin.sub_category.create',compact('id'),['title'=> trans('orbscope.add').' '.trans('orbscope.sub_category'),'cats'=>$cat]);
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
            'cat_id'      =>'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'cat_id' =>trans('orbscope.category'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $sub = new SubCategory;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('ar_name'));
            $names = EncodeVar($name);

            $sub->name           = $names;
            $sub->cat_id	       = $request->input('cat_id');
            $sub->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$sub->id),
                    'type'   =>'add',
                    'table'  =>'sub_categories',
                    'route'  =>LogRoute('sub_category'),
                    'data'   =>'log.add_record'.' | '.'orbscope.sub_categorys'.' | '.' log.record_number '.' | '.$sub->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/subcategory/'.$sub->cat_id);

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
        $sub = SubCategory::find($id);
        return view('admin.sub_category.edit',['edit'=>$sub,'title'=>trans('orbscope.edit').' '.trans('orbscope.sub_category').' : '.VarByLang($sub->name,GetLanguage()) ]);
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
            $sub = SubCategory::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('ar_name'));
            $names = EncodeVar($name);

            $sub->name           = $names;
            $sub->save();
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/subcategory/'.$sub->cat_id);

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
        $sub = SubCategory::find($id);
        $sub->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$sub->id),
            'type'   =>'delete',
            'table'  =>'sub_categories',
            'route'  =>LogRoute('sub_category'),
            'data'   =>'log.delete_record'.' | '.'orbscope.sub_category'.' | '.' log.record_number '.' | '.$sub->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect()->back();
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $sub   = SubCategory::find($record);

                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'sub_categories',
                    'route'  =>LogRoute('sub_category'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.sub_category'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            SubCategory::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect()->back();
        }
        else {
            $sub_category = SubCategory::find($data);
            $sub_category->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'sub_categories',
                'route'  =>LogRoute('sub_category'),
                'data'   =>'log.delete_record'.' | '.'orbscope.sub_category'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect()->back();
    }
    }





    public function subcat_ajax(Request $request){
        $data=Category::where('shop_id',$request->shop)->where('status','active')->get();
        return view('admin.sub_category.cats',['data'=>$data]);
    }
}
