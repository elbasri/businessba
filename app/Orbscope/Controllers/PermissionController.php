<?php

namespace App\Orbscope\Controllers;

use Illuminate\Http\Request;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Orbscope\DataTables\PermissionsDatatable;
use Session;
use Validator;
class PermissionController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'PermisionAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(permissionsDatatable $dataTable) {
        return $dataTable->render('admin.permissions.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.permissions')]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {

        // dd(Permission::pluck('name')->toArray());
        $roles = Role::get(); //Get all roles
        return view('admin.permissions.create', [
            'title'     => trans('orbscope.permissions'),
            'roles'     => $roles,
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
        $rules = [
            'name'         => 'required|unique:permissions|max:50',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'         => trans('orbscope.permision_name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        session()->flash('success',trans('orbscope.added-message'));
        // return redirect()->route('permissions.index');
        return redirect()->back();

    }



    public function show($id) {
        return view('admin.permissions.show', [
            'title'       => trans('orbscope.role_name'),
            'role'        => $role,
        ]);
    }



    public function edit($id) {
        $permission = Permission::findOrFail($id);
        $roles = Role::get(); //Get all roles
        return view('admin.permissions.edit', [
            'title'       => trans('orbscope.permissions'),
            'permission' => $permission,
            'roles'     => $roles,
        ]);
    }



    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        $rules = [
            'name'         => 'required|unique:permissions,name,'.$permission->id.',id',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'         => trans('orbscope.permision_name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $permission->fill($input)->save();
        session()->flash('success',trans('log.edit_record'));
        return redirect()->route('permissions.index');

    }


    public function destroy($id) {
        $permission = Permission::findOrFail($id);
        //Make it impossible to delete this specific permission
        if ($permission->name == "Admin") {
            session()->flash('error','error this permision can not be deleted');
            return redirect()->route('permissions.index');
        }
        $permission->delete();
        session()->flash('success',trans('log.delete_record'));
        return redirect()->route('permissions.index');

    }
}
