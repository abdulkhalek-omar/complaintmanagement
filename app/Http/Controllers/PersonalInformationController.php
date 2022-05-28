<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Place;
use App\Models\State;
use App\Services\CustomerService;
use App\Services\EmployeeService;
use App\Services\PersonalDataService;
use App\Services\UserService;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PersonalInformationController extends Controller
{
    public function index(PersonalDataService $dataService)
    {
        abort_if(!Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalInfo = $dataService->getPersonalData();

        $places = Place::all();
        $states = State::all();
        $countries = Country::all();

        return view('personal-information.create', compact(['personalInfo', 'places', 'states', 'countries']));
    }

    public function store(StoreProfileRequest $request, UserService $userService)
    {
        abort_if(!Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userService->updateOrCreateUser($request);

        return redirect()->route('personal-information.index');
    }
}
