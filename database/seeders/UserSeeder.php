<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'vendor']);
        Role::firstOrCreate(['name' => 'user']);

        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
                'photo' => 'upload/admin_images/default.png',
            ]
        );
        $admin->syncRoles(['admin']);

        $vendor = User::updateOrCreate(
            ['email' => 'vendor@gmail.com'],
            [
                'name' => 'Alostab Vendor',
                'username' => 'vendor',
                'password' => Hash::make('111'),
                'role' => 'vendor',
                'status' => 'active',
                'email_verified_at' => now(),
                'photo' => 'upload/vendor_images/default.png',
            ]
        );
        $vendor->syncRoles(['vendor']);

        $customer = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'username' => 'user',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active',
                'email_verified_at' => now(),
                'photo' => 'upload/user_images/default.png',
            ]
        );
        $customer->syncRoles(['user']);

        // Grant all existing permissions to admin role if permission records exist.
        $permissions = Permission::query()->pluck('name')->all();
        if (!empty($permissions)) {
            $adminRole->syncPermissions($permissions);
        }

        User::factory()->count(2)->admin()->create();
        User::factory()->count(10)->vendor()->create();
        User::factory()->count(35)->customer()->create([
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
    }
}