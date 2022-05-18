<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Place;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PersonalInformationController extends Controller
{
    public function index()
    {
        abort_if(!Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();

        $personalInfo = Customer::getCustomer($user);
        $places = Place::all();
        $states = State::all();
        $countries = Country::all();

        return view('personal-information.create', compact(['personalInfo', 'places', 'states', 'countries']));
    }

    public function store(StoreProfileRequest $request)
    {
        dd($request);
        Customer::updateOrCreate($request->validated());

        return redirect()->route('personal-information.index');
    }
}
