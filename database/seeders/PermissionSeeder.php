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
        //academy=1,3,4,5,6,7
        //super=1,2,3,4,5,6,7,8
        Permission::create([
            'name'=>'admins',
            'guard_name'=>'web',
            'slug'=>'إدارة أعضاء الإدارة'
        ]);
        Permission::create([
            'name'=>'academies',
            'guard_name'=>'web',
            'slug'=>'إدارة الأكاديميات'
        ]);
        Permission::create([
            'name'=>'coaches',
            'guard_name'=>'web',
            'slug'=>'إدارة المدربين'
        ]);
        Permission::create([
            'name'=>'players',
            'guard_name'=>'web',
            'slug'=>'إدارة اللاعبين'
        ]);
        Permission::create([
            'name'=>'invoices',
            'guard_name'=>'web',
            'slug'=>'إدارة الاشتراكات'
        ]);
        Permission::create([
            'name'=>'groups',
            'guard_name'=>'web',
            'slug'=>'إدارة الجروبات'
        ]);
        Permission::create([
            'name'=>'courses',
            'guard_name'=>'web',
            'slug'=>'إدارة الكورسات'
        ]);
        Permission::create([
            'name'=>'settings',
            'guard_name'=>'web',
            'slug'=>'إدارة محتويات النظام'
        ]);

    }
}
