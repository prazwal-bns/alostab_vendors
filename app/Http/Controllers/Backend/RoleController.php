<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.roles_PermissionPages.permission.all_permission',compact('permissions'));
    }
    // END FUNCTION

    public function AddPermission(){
        return view('backend.roles_PermissionPages.permission.add_permission');
    }
    // END FUNCTION


    public function StorePermission(Request $request){
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => "Permission Inserted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }
    // END FUNCTION

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);
        return view('backend.roles_PermissionPages.permission.edit_permission',compact('permission'));
    }
    // END FUNCTION

    public function UpdatePermission(Request $request)
    {
        $per_id = $request->id;
        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => "Permission Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }
    // END FUNCTION

    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => "Permission Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // END FUNCTION


    // FOR ROLES
    public function AllRoles()
    {
        $roles = Role::all();
        return view('backend.roles_PermissionPages.roles.all_roles', compact('roles'));
    }
    // END FUNCTION

    public function AddRoles()
    {
        return view('backend.roles_PermissionPages.roles.add_roles');
    }
    // END FUNCTION

    public function StoreRoles(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => "Roles Inserted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }
    // END FUNCTION

    public function EditRoles($id)
    {
        $roles = Role::findOrFail($id);
        return view('backend.roles_PermissionPages.roles.edit_roles', compact('roles'));
    }
    // END FUNCTION

    public function UpdateRoles(Request $request)
    {
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => "Role Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }
    // END FUNCTION

    public function DeleteRoles($id)
    {
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => "Role Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // END FUNCTION


    // ADD ROLES PERMISSION
    public function AddRolesPermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('backend.roles_PermissionPages.roles.add_roles_permission',compact('roles','permissions', 'permission_groups'));
    }
    // END FUNCTION

    // public function StoreRolePermission(Request $request){
    //     $data = array();
    //     $permissions = $request->permission;

    //     foreach($permissions as $item){
    //         $data['role_id'] = $request->role_id;
    //         $data['permission_id'] = $item;

    //         DB::table('role_has_permissions')->insert($data);
    //     }

    //     $notification = array(
    //         'message' => "Role and Permission added Successfully",
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->route('all.roles.permission')->with($notification);
    // }

    public function StoreRolePermission(Request $request)
    {
        $permissions = $request->permission;
        $role_id = $request->role_id;

        foreach ($permissions as $permission_id) {
            // Check if the record already exists
            $existingRecord = DB::table('role_has_permissions')
            ->where('role_id', $role_id)
                ->where('permission_id', $permission_id)
                ->exists();

            // Insert the record only if it doesn't already exist
            if (!$existingRecord) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        $notification = [
            'message' => "Role and Permission added Successfully",
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles.permission')->with($notification);
    }

    // END FUNCTION


    public function AllRolesPermission()
    {
        $roles = Role::all();
        return view('backend.roles_PermissionPages.roles.all_roles_permission', compact('roles'));
    }
    // END FUNCTION

    public function AdminEditRoles($role_id)
    {
        $role = Role::findOrFail($role_id);
        $permission = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('backend.roles_PermissionPages.roles.edit_role_permission',compact('permission','role','permission_groups'));

    }
    // END FUNCTION

    // public function AdminUpdateRoles(Request $request, $id)
    // {
    //     $role = Role::findOrFail($id);
    //     $permissions = $request->permission;
        
    //     dd([$role, $permissions]);

    //     if (!empty($permissions)) {
    //         $role->syncPermissions($permissions);
    //     }

    //     $notification = array(
    //         'message' => 'Role Permission Updated Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all.roles.permission')->with($notification);
    // }
    // End Method 

    public function AdminUpdateRoles(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        // Remove existing permissions for the role
        DB::table('role_has_permissions')->where('role_id', $id)->delete();

        // Insert new permissions for the role
        foreach ($permissions as $permissionId) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $id,
                'permission_id' => $permissionId,
            ]);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }
    // END FUNCTION

    public function AdminDeleteRoles($id){
        $role = Role::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }
        $notification = array(
            'message' => 'Role and Permission Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // END FUNCTION

}

