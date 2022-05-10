<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tickets.index', [
            'cards' => CustomerManagement::all()->sortByDesc('closed')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {

    }

    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        return view('tickets.show');
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
    }
}
