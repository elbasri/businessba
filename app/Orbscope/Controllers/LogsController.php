<?php

namespace App\Orbscope\Controllers;
use App\Orbscope\DataTables\LogsDataTable;
use App\Orbscope\DataTables\ContactMessagesDatatable;
use App\Orbscope\Models\Log;
use App\Orbscope\Models\Setting;
use App\Orbscope\Models\ContactUs;
use App\User;
use Illuminate\Http\Request;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Validator;
use File;

class LogsController extends Controller
{
    /**
     * @param LogsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(LogsDataTable $dataTable)
    {
        return $dataTable->render('admin.logs.index',['title' =>trans('log.logs')]);
    }

    public function recover($id){

       //$log=Log::find($id);

    }

    // Create Save Log
    public static function SaveLog($data=[])
    {
        $log = new Log;
        foreach($data as $key => $value)
        {
            $log->$key = $value;
        }
        $log->user_id = auth()->user()->id;
        $log->save();
    }


    public function destroy($id)
    {
        $leadSource = Log::find($id);
        $leadSource->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/logs');
    }


    public function store_pass(Request $request){
        $rules = [
            'name' => 'required',
            'email'        => 'required|unique:users',

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'             =>trans('orbscope.name'),
            'email'             =>trans('orbscope.name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{
            $user=User::find(auth()->user()->id);
            $user ->name =$request->name;
            $user ->email =$request->email;
            $user ->phone =$request->phone;
            //if(!empty($request->password) && count($request->password) > 0 ){
            if(!empty($request->password)){

                $user->password = bcrypt($request->password);
            }
            $user->save();
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect()->back();

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Multi Delete
     */
    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            Log::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/logs');
        }
        else {
            $leadSource = Log::find($data);
            $leadSource->delete();
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/logs');
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
        $Log = Log::find($id);
        return view('admin.logs.show',['show'=>$Log,'title'=>trans('orbscope.show').' '.trans('orbscope.logs').' : '.VarByLang($Log->action,GetLanguage())]);
    }



    public function settings_show()
    {
        return view('admin.settings.show', [
            'title' => trans('log.settings'),
            'show'  => Setting::orderBy('id','desc')->first(),
        ]);
    }

    public function settings_update(Request $request) {
        $rules = [
            'ar_name' => 'required',
            'en_name' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'             =>trans('orbscope.ar-name'),
            'en_name'             =>trans('orbscope.en-name')
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $setting = Setting::orderBy('id','desc')->first();
        $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
        $names = EncodeVar($name);
        $setting->name   =  $names;
        $setting->email  =  $request->email;
        $setting->phone  =  $request->phone;
        $setting->mobile =  $request->mobile;
        $setting->copy_right =  $request->copy_right;
        $setting->color  =  $request->color;
        $setting->login_color  =  $request->login_color;
        if($request->hasFile('logo')){
            $image        = $request->file('logo');
            $uploaded     = Upload::uploadImages('images', $image,'checkImages');
            if($uploaded == 'false'){
                return back()->withInput();
            }else{
                @unlink('uploads/'.$setting->logo);
                $setting->logo           = $uploaded;
            }
        }
        if($request->hasFile('icon_image')){
            $icon            = $request->file('icon_image');
            $upload_icon     = Upload::uploadImages('images', $icon,'checkImages');
            if($upload_icon == 'false'){
                return back()->withInput();
            }else{
                @unlink('uploads/'.$setting->icon);
                $setting->icon           = $upload_icon;
            }
        }

        $keywords     = array('ar'=>$request->input('ar_keywords'),'en'=>$request->input('en_keywords'));
        $keywords     = EncodeVar($keywords);
        $setting->keywords =  $keywords;
        $address      = array('ar'=>$request->input('ar_address'),'en'=>$request->input('en_address'));
        $addresses    = EncodeVar($address);
        $setting->address     =  $addresses;

        $setting->language =  $request->language;
        $setting->multi_lang =  $request->multi_lang;
        $setting->session_timeout =  $request->session_timeout;




        $setting->facebook              = $request->facebook;
        $setting->twitter               = $request->twitter;

        $setting->save();
        if ($setting) {
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/settings/');
        }else {
            abort(404);
        }
    }


    public function profile(){

        return view('admin.profile');
    }


}
