<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected  $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // USER ACTIVE NOW
    public function UserOnline(){
        return Cache::has('user-is-online' . $this->id);
    }

    public static function generateUserNameFromName($name){
        // Extract a portion of the name or use the whole name, depending on your preference
        $username = Str::lower(str_replace(' ', '', $name));
    
        if(static::where('username', $username)->exists()){
            $newUsername = $username . Str::lower(Str::random(3));
            $username = static::generateUserNameFromName($newUsername);
        }
    
        return $username;
    }
    // END METHOD
    
    public static function getPermissionGroups(){
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }
    // END METHOD

    public static function getPermissionByGroupName($group_name){
        $permissions = DB::table('permissions')->select('name','id')->where('group_name',$group_name)->get();
        return $permissions;
    }
    // END METHOD

    public static function roleHasPermissions($role,$permissions){
        $hasPermission = true;
        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
        return $hasPermission;
        }
    }
    // END METHOD

    public function canAll($permissionName) {
        $auth_user = Auth::user()->id;
        $role_id = DB::table('model_has_roles')
        ->where('model_id', $auth_user)
        ->value('role_id');

        $permissions = DB::table('role_has_permissions')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->select('permissions.name')
        ->where('role_has_permissions.role_id', $role_id)  
        ->get();
        
        $permissionNames = $permissions->pluck('name')->toArray();
        if(in_array($permissionName, $permissionNames)) {
            return true;
        }
        return false;
    }
}
