<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::get();
        $role = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);
        $role->syncPermissions($permissions);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'image' => 'm.jpeg',
            'role_id' => 1,
            'isActive' => 1,
        ]);
        $user->assignRole($role);
    }
}
