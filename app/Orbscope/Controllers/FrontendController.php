<?php

namespace App\Orbscope\Controllers;
use App\Notifications\NewReportNotification;
use App\Orbscope\Models\ContactUs;
use App\Orbscope\Models\Form_job;
use App\Orbscope\Models\Guide;
use App\Orbscope\Models\School;
use App\Orbscope\Models\Setting;
use Notification;
use DB;
use App\Orbscope\Models\Log;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Logs;
use File;
use Intervention\Image\ImageManager;
use Agents;
use Route;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Validator;

class FrontendController extends Controller
{


    public function index(){

        
      return redirect('/admin');

    }

    public function contact(){
        return view('front.contact');
    }

    public function contact_us(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            'message' => 'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'email'  =>trans('orbscope.email'),
            'name'  =>trans('orbscope.name'),
            'message'     =>trans('orbscope.message'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $c = new ContactUs();
            $c->email = $request->email;
            $c->name = $request->name;
            $c->subject = $request->subject;
            $c->message = $request->message;
            $c->save();
            session()->flash('scusses', trans('frontend.contactMessage'));
            return redirect()->back();


        }


    }




}
