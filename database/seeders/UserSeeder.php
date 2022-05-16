<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'username'       => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at'     => '2022-05-16 02:33:05',
                'updated_at'     => '2022-05-16 02:33:05',
            ],
            [
                'id'             => 2,
                'username'       => 'Employee',
                'email'          => 'employee@employee.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at'     => '2022-05-16 02:33:05',
                'updated_at'     => '2022-05-16 02:33:05',
            ],
            [
                'id'             => 3,
                'username'       => 'User',
                'email'          => 'user@user.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at'     => '2022-05-16 02:33:05',
                'updated_at'     => '2022-05-16 02:33:05',
            ],
        ];

        User::insert($users);
    }
}
