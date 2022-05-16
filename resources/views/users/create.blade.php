<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="container bg-white pt-3 pb-3">
        <div class="row">
            <div class="col-12">

                <x-jet-validation-errors class="mb-3"/>

                <form method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="row g-3">

                        <div class="col-sm-12">
                            <x-jet-label value="{{ __('Username') }}"/>

                            <x-jet-input class="{{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                                         name="username"
                                         :value="old('username')" required autofocus autocomplete="username"/>
                            <x-jet-input-error for="username"></x-jet-input-error>
                        </div>


                        <div class="col-sm-12">
                            <x-jet-label value="{{ __('Email') }}"/>

                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                         name="email"
                                         :value="old('email')" required/>
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="col-sm-12">
                            <x-jet-label value="{{ __('Password') }}"/>

                            <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                         name="password" required autocomplete="new-password"/>
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>

                        <div class="col-sm-12">
                            <label for="roles" class="text-muted">{{ __('Roles') }}</label>
                            <select name="roles[]" id="roles" class="form-control" multiple="multiple">
                                @foreach($roles as $id => $role)
                                    <option
                                        value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <button class="btn-outline-secondary form-control">
                                {{ __('Create') }}
                            </button>
                        </div>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-info btn-sm">Back to list</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
