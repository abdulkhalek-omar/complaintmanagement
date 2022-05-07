<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="container bg-white pt-3 pb-3">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="username" class="">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   value="{{ old('username', $user->username) }}"/>
                            @error('username')
                            <p class="">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label for="email" class="">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ old('email', $user->email) }}"/>
                            @error('email')
                            <p class="">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label for="password" class="">Password</label>
                            <input type="password" name="password" id="password" class="form-control"/>
                            @error('password')
                            <p class="">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label for="roles" class="">Roles</label>
                            <select name="roles[]" id="roles" class="form-control" multiple="multiple">
                                @foreach($roles as $id => $role)
                                    <option
                                        value="{{ $id }}"{{ in_array($id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                            <p class="">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <button class="btn-outline-secondary form-control">
                                Edit
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
