<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Personal Information') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="h5">
                        </h3>

                        <p class="mt-1 text-muted">
                            <span class="small">
                                {{__('Update your personal account\'s profile information.')}}
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <form method="POST" action="{{ route('personal-information.store') }}">
                    @csrf

                    <div class="card-body">
                        <!-- Start Input Fields -->

                        <!-- Forename -->
                        <div class="mb-3">
                            <x-jet-label for="firstname" value="{{ __('Firstname') }}"/>
                            <x-jet-input id="firstname"
                                         type="text"
                                         class="{{ $errors->has('firstname') ? 'is-invalid' : '' }}"
                                         name="firstname"
                                         autocomplete="firstname"
                                         value=" {{ isset($personalInfo->firstname) ? $personalInfo->firstname : '' }} "
                                         autofocus
                            />
                            <x-jet-input-error for="firstname"/>
                        </div>

                        <!-- Surname -->
                        <div class="mb-3">
                            <x-jet-label for="surname" value="{{ __('Surname') }}"/>
                            <x-jet-input id="surname"
                                         type="text"
                                         class="{{ $errors->has('surname') ? 'is-invalid' : '' }}"
                                         name="surname"
                                         autocomplete="surname"
                                         value="{{ isset($personalInfo->surname) ? $personalInfo->surname : '' }}"
                            />
                            <x-jet-input-error for="surname"/>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <x-jet-label for="phone_number" value="{{ __('Phone Number') }}"/>
                            <x-jet-input id="phone_number"
                                         type="text"
                                         class="{{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                         name="phone_number"
                                         autocomplete="phone_number"
                                         value="{{$personalInfo->phone_number}}"
                            />
                            <x-jet-input-error for="phone_number"/>
                        </div>


                        <!-- Street -->
                        <div class="mb-3">
                            <x-jet-label for="street" value="{{ __('Street') }}"/>
                            <x-jet-input id="street"
                                         type="text"
                                         class="{{ $errors->has('street') ? 'is-invalid' : '' }}"
                                         name="street"
                                         autocomplete="street"
                                         value="{{ isset($personalInfo->street) ? $personalInfo->street : '' }}"
                            />
                        </div>


                        <!-- Place -->
                        <div class="mb-3">
                            <x-jet-label for="place_id" value="{{ __('Place') }}"/>
                            <select class="form-select" id="place_id" name="place_id">
                                @foreach($places as $place)
                                    <option
                                        value="{{__($place->id)}}"
                                        @isset($personalInfo->fk_place_id)
                                            @if($place->id == $personalInfo->fk_place_id) selected @endif>
                                        @endisset
                                        {{__($place->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- State -->
                        <div class="mb-3">
                            <x-jet-label for="state_id" value="{{ __('State') }}"/>
                            <select class="form-select" id="state_id" name="state_id">
                                @foreach($states as $state)
                                    <option
                                        value="{{__($state->id)}}"
                                        @isset($personalInfo->fk_state_id)
                                            @if($state->id == $personalInfo->fk_state_id) selected @endif>
                                        @endisset
                                        {{__($state->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Country -->
                        <div class="mb-3">
                            <x-jet-label for="country_id" value="{{ __('Country') }}"/>
                            <select class="form-select" id="country_id" name="country_id">
                                @foreach($countries as $country)
                                    <option
                                        value="{{__($country->id)}}"
                                        @isset($personalInfo->fk_country_id)
                                            @if($country->id == $personalInfo->fk_country_id) selected @endif>
                                        @endisset
                                        {{__($country->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="card-footer d-flex justify-content-end mt-5">
                            <div class="d-flex align-items-baseline">
                                <button type="submit" class="btn btn-dark text-uppercase">
                                    {{__('Save')}}
                                </button>
                            </div>
                        </div>

                        <!-- End Input Fields -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--@endif--}}
</x-app-layout>
