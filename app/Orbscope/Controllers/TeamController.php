<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Member;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\teamDataTable;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class TeamController extends Controller
{
    //use Authorizable;
    /**
     * @param teamDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(teamDataTable $dataTable)
    {
        return $dataTable->render('admin.team.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.team')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.team.create',compact('roles'),['title'=> 'اضافة عضو جديد']);
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
            'name'         => 'required',
            'password'     => 'required',
            'email'        => 'required|unique:users',
            'username'        => 'required|unique:users',
            'type'        => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'       =>trans('orbscope.name'),
            'email'      =>trans('orbscope.email'),
            'password'   =>trans('orbscope.password'),
            'type'        =>'الرتبة',
            'user_name'        =>'اسم المستخدم',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $team                 = new User();
            if($request->input('type') != '' && !empty($request->input('type'))){
                $rank     = implode('|',$request->input('type'));
            }else{
                $rank ='';
            }

            $team->name           = $request->input('name');
            $team->username      = $request->input('username');
            $team->email          = $request->input('email');
            $team->password       = bcrypt($request->input('password'));
            $team->bio            = $request->input('details');
            $team->phone          = $request->input('whats_app');
            $team->bio            = $request->input('details');
            $team->facebook       = $request->input('facebook');
            $team->vodafon_cache  = $request->input('vodafon_cache');
            $team->name_posta     = $request->input('name_posta');
            $team->nationalnumber_posta  = $request->input('nationalnumber_posta');
            $team->others         = $request->input('others');
            $team->rank         = $rank;
            $team->type           = 'assistant';
            if (auth()->user()->parent ==1){
                $team->parent           = 2;
                $team->team_leader           = auth()->user()->id;

            }elseif (auth()->user()->parent ==2){
                $team->parent           = 3;
                $team->team_leader           = auth()->user()->id;
            }
            else{
                $team->parent           = 1;
            }
            $team->save();


            $roles = $request['type'];
            //Retrieving the roles field
            //Checking if a role was selected
            if (isset($roles)) {
                foreach ($roles as $role) {
                    $role_r = Role::where('id', '=', $role)->firstOrFail();
                    $team->assignRole($role_r);
                    //Assigning role to user
                }
            }

            if(auth()->user()->parent == 1 || auth()->user()->parent == 2){

                $new=new Member();
                $new->parent_id =auth()->user()->id;
                $new->child_id =$team->id;
                $new->save();


            }


            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$team->id),
                    'type'   =>'add',
                    'table'  =>'team',
                    'route'  =>LogRoute('team'),
                    'data'   =>'log.add_record'.' | '.'orbscope.team'.' | '.' log.record_number '.' | '.$team->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();
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
        $team             = User::find($id);
        $agent_type         = AgentType::find($team->agent_type);
        return view('admin.team.show',['show'=>$team,'agent_type'=>$agent_type,'title'=>trans('orbscope.show').' '.trans('orbscope.team').' : '.$team->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $agent = User::find($id);
        $roles = Role::get(); //Get all roles
        if ($agent) {
            $agentTypes = AgentType::all();
            return view('admin.team.edit',[
                'title'=> trans('orbscope.add').' '.trans('orbscope.team'),
                'edit' => $agent,
                'agentTypes'=>$agentTypes,
                'roles'=>$roles,

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $team = User::find($id);
        if ($team) {
            $rules = [
                'name'         => 'required',
                'password'     => 'sometimes|nullable|min:6',
                'email'        => 'required|unique:users,email,'.$id.',id',
                'agentType'        => 'required|integer',
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->SetAttributeNames([
                'name'       =>trans('orbscope.name'),
                'email'      =>trans('orbscope.email'),
                'password'   =>trans('orbscope.password'),
                'agentType'   =>trans('orbscope.agentType'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $team->name           = $request->input('name');
            $team->email          = $request->input('email');
            if ($request->input('password') != '') {
                $team->password       = bcrypt($request->input('password'));
            }
            $team->agent_type     = $request->input('agentType');
            if ($request->image != '') {
                if (! is_null($team->image)) {
                    if (File::exists(public_path('uploads') . '/' . $team->image)) {
                        unlink(public_path('uploads') . '/' . $team->image);
                    }
                }
                $uploaded_image  = Upload::uploadImages('team', $request->image,'checkImages');
                if($uploaded_image == 'false'){
                    return back()->withInput();
                }else{
                    $team->image = $uploaded_image;
                }
            }
            $team->save();

            $roles = $request['roles']; //Retreive all roles
            if (isset($roles)) {
                $team->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $team->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }

            Logs::SaveLog([
                'action' =>LogAction('add',$team->id),
                'type'   =>'edit',
                'table'  =>'team',
                'route'  =>LogRoute('team'),
                'data'   =>'log.add_record'.' | '.'orbscope.team'.' | '.' log.record_number '.' | '.$team->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/team/'.$team->id);

        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $team = User::find($id);
        $team->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$team->id),
            'type'   =>'delete',
            'table'  =>'team',
            'route'  =>LogRoute('team'),
            'data'   =>'log.delete_record'.' | '.'orbscope.team'.' | '.' log.record_number '.' | '.$team->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/team');
    }


    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'team',
                    'route'  =>LogRoute('team'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.team'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            User::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/team');
        }
        else {
            $team = User::find($data);
            $team->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'team',
                'route'  =>LogRoute('team'),
                'data'   =>'log.delete_record'.' | '.'orbscope.team'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/team');
        }
    }


}
