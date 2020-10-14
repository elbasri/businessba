<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Category;
use App\Orbscope\Models\Page;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\PagesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class PagesController extends Controller
{

    use Authorizable;

    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.pages')]);
    }


    public function create()
    {
        $cats=Category::all();
        return view('admin.pages.create',compact('cats'),['title'=> trans('orbscope.add').' '.trans('orbscope.pages')]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'ar_name'           => 'required',
            'en_name'           => 'required',
            'ar_details'        => 'required',
            'en_details'        => 'required',
            'ar_description'    => 'required',
            'en_description'    => 'required',
            'status'            => 'required|in:active,inactive',
            'show_website'      => 'required|in:show,hide',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'   =>trans('orbscope.ar-name'),
            'en_name'   =>trans('orbscope.en-name'),
            'ar_details'  =>trans('orbscope.ar-details'),
            'en_details'  =>trans('orbscope.en-details'),
            'ar_description'  =>trans('orbscope.ar-description'),
            'en_description'  =>trans('orbscope.en-description'),
            'status'        =>trans('orbscope.status'),
            'show_website'  =>trans('orbscope.show_website'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $page = new Page();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);
            $detail = array('ar'=>$request->input('ar_details'),'en'=>$request->input('en_details'));
            $details = EncodeVar($detail);
            $desc = array('ar'=>$request->input('ar_description'),'en'=>$request->input('en_description'));
            $descs = EncodeVar($desc);

            $page->name           = $names;
            $page->details        = $details;
            $page->description    = $descs;

            $page->status         = $request->input('status');

            $page->show_website   = $request->input('show_website');
            if ($request->input('show_website') == 'show') {
                $page->url     = $request->input('url');
            }else {
                $page->url     = null;
            }

            // dd("Wedwed");
            $page->save();

            Logs::SaveLog([
                'action' =>LogAction('add',$page->id),
                'type'   =>'add',
                'table'  =>'pages',
                'route'  =>LogRoute('pages'),
                'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$page->id ,
            ]);

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/pages/'.$page->id);

        }
    }


    public function show($id)
    {
        $page = Page::find($id);
        if ($page) {
            return view('admin.pages.show',['show'=>$page,'title'=>trans('orbscope.show').' '.trans('orbscope.page').' : '.VarByLang($page->name,GetLanguage())]);
        }
        return redirect(AdminPath());
    }


    public function edit($id)
    {
        $page = Page::find($id);
        if ($page) {
            return view('admin.pages.edit',['edit'=>$page,'title'=>trans('orbscope.edit').' '.trans('orbscope.page').' : '.VarByLang($page->name,GetLanguage()) ]);
        }
        return redirect(AdminPath());
    }



    public function update(Request $request, $id)
    {
        $rules = [
            'ar_name'           => 'required',
            'en_name'           => 'required',
            'ar_details'        => 'required',
            'en_details'        => 'required',
            'ar_description'    => 'required',
            'en_description'    => 'required',
            'status'            => 'required|in:active,inactive',
            'show_website'      => 'required|in:show,hide',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'   =>trans('orbscope.ar-name'),
            'en_name'   =>trans('orbscope.en-name'),
            'ar_details'  =>trans('orbscope.ar-details'),
            'en_details'  =>trans('orbscope.en-details'),
            'ar_description'  =>trans('orbscope.ar-description'),
            'en_description'  =>trans('orbscope.en-description'),
            'status'        =>trans('orbscope.status'),
            'show_website'  =>trans('orbscope.show_website'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $page = Page::find($id);
            if (!$page) {
                return back()->withInput();
            }
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);
            $detail = array('ar'=>$request->input('ar_details'),'en'=>$request->input('en_details'));
            $details = EncodeVar($detail);
            $desc = array('ar'=>$request->input('ar_description'),'en'=>$request->input('en_description'));
            $descs = EncodeVar($desc);

            $page->name           = $names;
            $page->details        = $details;
            $page->description    = $descs;
            $page->status         = $request->input('status');
            $page->show_website   = $request->input('show_website');
            if ($request->input('show_website') == 'show') {
                $page->url     = $request->input('url');
            }else {
                $page->url     = null;
            }

            $page->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/pages/'.$id);

        }
    }



    public function destroy($id)
    {
        $pages = Page::find($id);
        $pages->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$pages->id),
            'type'   =>'delete',
            'table'  =>'pages',
            'route'  =>LogRoute('pages'),
            'data'   =>'log.delete_record'.' | '.'orbscope.pages'.' | '.' log.record_number '.' | '.$pages->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/pages');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $pages = Page::find($record);
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'pages',
                    'route'  =>LogRoute('pages'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.pages'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Page::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/pages');
        } else {
            $pages = Page::find($data);
            @$pages->states()->delete();
            $pages->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'pages',
                'route'  =>LogRoute('pages'),
                'data'   =>'log.delete_record'.' | '.'orbscope.pages'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/pages');
        }
    }


}
