<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assoziationen synchronisieren: Many-to-Many-Assoziationen
//        $admin_permissions = Permission::all();
//        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
//
//
//        $employee_permissions = $admin_permissions->filter(function ($permission) {
//            return !str_starts_with($permission->title, 'employee_');
//        });
//        Role::findOrFail(2)->permissions()->sync($employee_permissions);
//
//        $user_permissions = $employee_permissions->filter(function ($permission) {
//            return !str_starts_with($permission->title, 'user_');
//        });
//        Role::findOrFail(3)->permissions()->sync($user_permissions);


        // Admin: Fully access
        Role::find(1)->permissions()->attach([1,2,3]);

        // Employee: User and Ticket access
        Role::find(2)->permissions()->attach([2,3]);

        // User: Only Ticket access
        Role::find(3)->permissions()->attach([3]);

    }
}
