<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                "name" => "Add Users",
                "name_dr" => "اضافه نمودن کاربران",
                "guard_name" => "web",
            ],
            [
                "name" => "Update Users",
                "name_dr" => "تجدید کاربران",
                "guard_name" => "web",
            ],
            [
                "name" => "Show Users",
                "name_dr" => "نمایش کاربران",
                "guard_name" => "web",
            ],
            [
                'name' => "Users List",
                'name_dr' => 'لیست کاربران',
                'guard_name' => "web",
            ],
            [
                'name' => "Users Activited",
                'name_dr' => 'فعال کردن کاربر',
                'guard_name' => "web",
            ],
            [
                'name' => "Users Deactived",
                'name_dr' => 'غیرفعال کردن کاربر',
                'guard_name' => "web",
            ],
            [
                'name' => "Permissions List",
                'name_dr' => 'لیست صلاحیت ها',
                'guard_name' => "web",
            ],
            [
                "name" => "Add Roles And Permissions",
                "name_dr" => "اضافه نمودن صلاحیت ها",
                "guard_name" => "web",
            ],
            [
                "name" => "Update Roles And Permissions",
                "name_dr" => "تجدید صلاحیت ها",
                "guard_name" => "web",
            ],
            [
                "name" => "Show Roles And Permissions",
                "name_dr" => "نمایش صلاحیت ها",
                "guard_name" => "web",
            ],
            [
                'name' => 'Setting',
                'name_dr' => 'تنظیمات',
                'guard_name' => 'web',
            ],

            // [
            //     "name" => "",
            //     "name_dr" => "",
            //     "guard_name" => 'web',
            // ],
            // [
            //     "name" => "",
            //     "name_dr" => "",
            //     "guard_name" => 'web',
            // ],


        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
