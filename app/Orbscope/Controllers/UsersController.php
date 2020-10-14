<?php

namespace App\Orbscope\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\UsersDataTable;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class UsersController extends Controller
{
    use Authorizable;
    /**
     * @param usersDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.users')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create',['title'=> trans('orbscope.add').' '.trans('orbscope.users'), 'roles' => $roles]);
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
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'       =>trans('orbscope.name'),
            'email'      =>trans('orbscope.email'),
            'password'   =>trans('orbscope.password'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $users                 = new User();
            $users->name           = $request->input('name');
            $users->email          = $request->input('email');
            $users->employee_id          = $request->input('employee_id');
            $users->password       = bcrypt($request->input('password'));
            $users->type           = 'agent';
            $users->active_date=date('Y-m-d');
            $users->save();

            $roles = $request['roles']; //Retrieving the roles field
            //Checking if a role was selected
            if (isset($roles)) {
                foreach ($roles as $role) {
                    $role_r = Role::where('id', '=', $role)->firstOrFail();
                    $users->assignRole($role_r); //Assigning role to user
                }
            }

            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$users->id),
                    'type'   =>'add',
                    'table'  =>'users',
                    'route'  =>LogRoute('users'),
                    'data'   =>'log.add_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$users->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/users');
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

        return redirect('/admin/users');
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
            return view('admin.users.edit',[
                'title'=> trans('orbscope.edit').' '.trans('orbscope.user'),
                'edit' => $agent,
                'roles'=>$roles,

            ]);
        }
    }


    public function user_status($id,$status){
        $user=User::find($id);
        $user->status=$status;
        if ($status=='inactive'){
         $user->inactive_date =date('Y-m-d');
        }else{
         $user->active_date=date('Y-m-d');
        }
        $user->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $users = User::find($id);
        if ($users) {
            $rules = [
                'name'         => 'required',
                'password'     => 'sometimes|nullable|min:6',
                'email'        => 'required|unique:users,email,'.$id.',id',
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->SetAttributeNames([
                'name'       =>trans('orbscope.name'),
                'email'      =>trans('orbscope.email'),
                'password'   =>trans('orbscope.password'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $users->name           = $request->input('name');
            $users->email          = $request->input('email');
            $users->employee_id          = $request->input('employee_id');
            if ($request->input('password') != '') {
                $users->password       = bcrypt($request->input('password'));
            }
            $users->save();

            $roles = $request['roles']; //Retreive all roles
            if (isset($roles)) {
                $users->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $users->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }

            Logs::SaveLog([
                'action' =>LogAction('add',$users->id),
                'type'   =>'edit',
                'table'  =>'users',
                'route'  =>LogRoute('users'),
                'data'   =>'log.add_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$users->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/users');

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
        $users = User::find($id);
        $users->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$users->id),
            'type'   =>'delete',
            'table'  =>'users',
            'route'  =>LogRoute('users'),
            'data'   =>'log.delete_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$users->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/users');
    }


    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'users',
                    'route'  =>LogRoute('users'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            User::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/users');
        }
        else {
            $users = User::find($data);
            $users->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'users',
                'route'  =>LogRoute('users'),
                'data'   =>'log.delete_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/users');
        }
    }




}
