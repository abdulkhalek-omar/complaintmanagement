<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use Carbon\Carbon;

class CustomerManagementController extends Controller
{
    public function index()
    {
        Carbon::setLocale('de');
        return view('tickets.index', [
            'cards' => CustomerManagement::all()->sortByDesc('closed')
        ]);
    }

    public function show()
    {

    }
}
