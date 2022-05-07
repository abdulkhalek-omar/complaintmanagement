<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div>
        <form method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="row g-3">

                <div class="col-sm-12">
                    <label for="username" class="form-label">{{ __('Username') }}</label>
                    <input type="text" name="username" id="username" class="form-control"
                           value="{{ old('username', '') }}"/>
                    @error('username')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>


                <div class="col-sm-12">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{ old('email', '') }}"/>
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control"/>
                    @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
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

                <div class="">
                    <button class="btn btn-outline-secondary btn-lg">
                        {{ __('Create') }}
                    </button>
                </div>

                <div class="">
                    <a href="{{ route('users.index') }}" class="">Back to list</a>
                </div>

            </div>
        </form>
    </div>

</x-app-layout>
