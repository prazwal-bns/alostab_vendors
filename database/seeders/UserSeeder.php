<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Support\CopiesDemoUserPhotos;
use Database\Seeders\Support\DemoAssetCatalog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        CopiesDemoUserPhotos::run();

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
                'photo' => DemoAssetCatalog::avatarFilename(1),
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
                'photo' => DemoAssetCatalog::vendorFilename(1),
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
                'photo' => DemoAssetCatalog::avatarFilename(2),
            ]
        );
        $customer->syncRoles(['user']);

        $permissions = Permission::query()->pluck('name')->all();
        if (! empty($permissions)) {
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
