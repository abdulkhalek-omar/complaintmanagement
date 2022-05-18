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
                <form method="POST" action="{{ route('personal-information.store') }}" >
                    @csrf

                    <div class="card-body">
                        <!-- Start Input Fields -->

                        <!-- Forename -->
                        <div class="mb-3">
                            <x-jet-label for="forename" value="{{ __('Forename') }}"/>
                            <x-jet-input id="forename"
                                         type="text"
                                         class="{{ $errors->has('forename') ? 'is-invalid' : '' }}"
                                         name="forename"
                                         autocomplete="forename"
                                         value="{{$personalInfo->firstname}}"
                                         autofocus
                            />
                            <x-jet-input-error for="forename"/>
                        </div>

                        <!-- Surname -->
                        <div class="mb-3">
                            <x-jet-label for="surename" value="{{ __('Surename') }}"/>
                            <x-jet-input id="surename"
                                         type="text"
                                         class="{{ $errors->has('surename') ? 'is-invalid' : '' }}"
                                         name="surename"
                                         autocomplete="surename"
                                         value="{{$personalInfo->surname}}"
                            />
                            <x-jet-input-error for="surename"/>
                        </div>


                        <!-- Street -->
                        <div class="mb-3">
                            <x-jet-label for="street" value="{{ __('Street') }}"/>
                            <x-jet-input id="street"
                                         type="text"
                                         class="{{ $errors->has('street') ? 'is-invalid' : '' }}"
                                         name="street"
                                         autocomplete="street"
                                         value="{{$personalInfo->street}}"
                            />
                        </div>


                        <!-- Place -->
                        <div class="mb-3">
                            <x-jet-label for="fk_place_id" value="{{ __('Place') }}"/>
                            <select class="form-select" id="fk_place_id" name="fk_place_id">
                                @foreach($places as $place)
                                    <option
                                        value="{{__($place->id)}}"
                                        @if($place->id == $personalInfo->fk_place_id) selected @endif>
                                        {{__($place->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- State -->
                        <div class="mb-3">
                            <x-jet-label for="fk_state_id" value="{{ __('State') }}"/>
                            <select class="form-select" id="fk_state_id" name="fk_state_id">
                                @foreach($states as $state)
                                    <option
                                        value="{{__($state->id)}}"
                                        @if($state->id == $personalInfo->fk_state_id) selected @endif>
                                        {{__($state->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Country -->
                        <div class="mb-3">
                            <x-jet-label for="fk_country_id" value="{{ __('Country') }}"/>
                            <select class="form-select" id="fk_country_id" name="fk_country_id">
                                @foreach($countries as $country)
                                    <option
                                        value="{{__($country->id)}}"
                                        @if($country->id == $personalInfo->fk_country_id) selected @endif>
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
