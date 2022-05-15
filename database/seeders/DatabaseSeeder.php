<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerManagement;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeManagement;
use App\Models\Keyword;
use App\Models\ManagementHierarchie;
use App\Models\Place;
use App\Models\State;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Roles and Permissions
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            PermissionRoleSeeder::class,
            UserSeeder::class,
            RoleUserSeeder::class,
            Keyword::class,
        ]);


        // general Fake Data
        Place::factory(50)->create();
        State::factory(50)->create();
        Country::factory(50)->create();
        Customer::factory(50)->create();
        Ticket::factory(50)->create();
        Department::factory(50)->create();
        Employee::factory(50)->create();
        Keyword::factory(50)->create();
        CustomerManagement::factory(50)->create();
        EmployeeManagement::factory(50)->create();
        ManagementHierarchie::factory(50)->create();
    }
}
