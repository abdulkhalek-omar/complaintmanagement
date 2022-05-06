<?php

namespace Database\Seeders;

use App\Http\Models\AnsweredTicket;
use App\Http\Models\Client;
use App\Http\Models\Complaint;
use App\Http\Models\Department;
use App\Http\Models\Employee;
use App\Http\Models\Keyword;
use App\Http\Models\State;
use App\Http\Models\Ticket;
use App\Http\Models\User;
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
        State::factory(50)->create();
        Department::factory(50)->create();
        Keyword::factory(50)->create();
        Complaint::factory(50)->create();
        User::factory(500)->create();
        Employee::factory(50)->create();
        Client::factory(50)->create();
        Ticket::factory(50)->create();
        AnsweredTicket::factory(50)->create();
    }
}
