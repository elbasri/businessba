<?php

namespace App\Orbscope\Controllers;

use Illuminate\Http\Request;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Orbscope\DataTables\RolesDatatable;
use App\Orbscope\DataTables\UserRolesDataTable;
use Validator;
use App\Authorizable;

class RoleController extends Controller {

    use Authorizable;
    public function __construct() {
        $this->middleware(['auth', 'PermisionAdmin']);//PermisionAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index(RolesDatatable $dataTable) {
        return $dataTable->render('admin.roles.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.roles')]);
    }

    public function create() {
        $permissions = Permission::all(); //Get all permissions
        return view('admin.roles.create', [
            'title' => trans('orbscope.role_name'),
            'permissions'=>$permissions
        ]);
    }

     public function store(Request $request) {
         $rules = [
             'name'         => 'required|unique:roles',
             'permissions'  => 'required',
         ];
         $validator = Validator::make($request->all(),$rules);
         $validator->SetAttributeNames([
             'name'         => trans('orbscope.role_name'),
             'permissions'  => trans('orbscope.permissions')
         ]);
         if ($validator->fails()) {
             return back()->withInput()->withErrors($validator);
         }
         $name = $request['name'];
         $role = new Role();
         $role->name = $name;
         if (array_search('Admin', $request['permissions'])) { // returns false if not found
             $permissions = array_except($request['permissions'], array_search('Admin', $request['permissions']));
         }else {
             $permissions = $request['permissions'];
         }
         $role->save();
         if($role->name === 'Admin') {
             $role->syncPermissions(Permission::all());
         } else {
             //Looping thru selected permissions
             foreach ($permissions as $permission) {
                 if (Permission::find($permission)) {
                     $p = Permission::where('id', '=', $permission)->firstOrFail();
                     //Fetch the newly created role and assign permission
                     $role = Role::where('name', '=', $name)->first();
                     $role->givePermissionTo($p);
                 }
             }
         }
         session()->flash('success',trans('orbscope.added-message'));
         return redirect()->route('roles.index');
     }


    public function show(UserRolesDataTable $dataTable, $id) {
        // GetRoleName
        $role = Role::find($id);
        if ($role) {
            return $dataTable->GetRoleName($role->name)->render('admin.roles.show',[
                'title' => trans('orbscope.show-all').' '.trans('orbscope.roles'),
                'show' => $role,
            ]);
        }
        return redirect()->back();
    }


    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', [
            'title'       => trans('orbscope.role_name'),
            'role'        => $role,
            'permissions' => $permissions
        ]);
    }


    public function update(Request $request, $id) {
        $role = Role::find($id);
        if ($role) {
            if ($role->name == 'Admin') {
                session()->flash('error',trans('orbscope.error-message-role'));
            } else {
                $rules = [
                    'name'         => 'required|unique:roles,name,'.$id.',id',
                    'permissions'  => 'required',
                ];
                $validator = Validator::make($request->all(),$rules);
                $validator->SetAttributeNames([
                    'name'         => trans('orbscope.role_name'),
                    'permissions'  => trans('orbscope.permisions')
                ]);
                if ($validator->fails()) {
                    return back()->withInput()->withErrors($validator);
                }
                $input = $request->except(['permissions']);
                $permissions = $request['permissions'];
                $role->fill($input)->save();
                $p_all = Permission::all(); //Get all permissions
                foreach ($p_all as $p) {
                    $role->revokePermissionTo($p); //Remove all permissions associated with role
                }
                foreach ($permissions as $permission) {
                    $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                    $role->givePermissionTo($p);  //Assign permission to role
                }
                session()->flash('success',trans('orbscope.added-message'));
            }
            return redirect()->route('roles.index');
        }
        return back()->withErrors(['There Is Some Error']);
    }


    public function destroy($id) {
        $role = Role::findOrFail($id);
        if ($role) {
            if ($role->name == 'Admin') {
                session()->flash('error',trans('orbscope.error-message-role'));
            } else {
                session()->flash('success',trans('orbscope.deleted-message'));
                $role->delete();
            }
        }
        return redirect()->route('roles.index');
    }


}
