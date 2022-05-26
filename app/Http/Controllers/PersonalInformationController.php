<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
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

        $personalInfo = null;

        if (!strcmp(session('role'), 'Employee')) {
            $personalInfo = Employee::where('id', session('employee_id'))->first();
        }
        if (!strcmp(session('role'), 'User')) {
            $personalInfo = Customer::where('id', session('customer_id'))->first();
        }

        $places = Place::all();
        $states = State::all();
        $countries = Country::all();

        return view('personal-information.create', compact(['personalInfo', 'places', 'states', 'countries']));
    }

    public function store(StoreProfileRequest $request)
    {
        abort_if(!Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validated();

        if (!strcmp(session('role'), 'Employee')) {
            Employee::updateOrCreate(
                [
                    'id' => session('employee_id')
                ],
                [
                    'firstname' => $validated['firstname'],
                    'surname' => $validated['surname'],
                    'phone_number' => $validated['phone_number'],
                    'street' => $validated['street'],
                    'fk_place_id' => $validated['place_id'],
                    'fk_state_id' => $validated['state_id'],
                    'fk_country_id' => $validated['country_id'],
                ]);
        }
        if (!strcmp(session('role'), 'User')) {
            Customer::updateOrCreate(
                [
                    'id' => session('customer_id')
                ],
                [
                    'firstname' => $validated['firstname'],
                    'surname' => $validated['surname'],
                    'phone_number' => $validated['phone_number'],
                    'street' => $validated['street'],
                    'fk_place_id' => $validated['place_id'],
                    'fk_state_id' => $validated['state_id'],
                    'fk_country_id' => $validated['country_id'],
                ]);

        }

        return redirect()->route('personal-information.index');
    }
}
