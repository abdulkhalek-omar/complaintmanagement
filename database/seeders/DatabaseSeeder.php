<?php

namespace Database\Seeders;

use App\Models\AnsweredTicket;
use App\Models\Client;
use App\Models\Complaint;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Keyword;
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
