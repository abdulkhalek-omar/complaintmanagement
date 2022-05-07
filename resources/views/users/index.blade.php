<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <a href="{{ route('users.create') }}"
       class="btn btn-outline-success mb-3">
        {{ __('Add User') }}
    </a>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped align-middle bg-white table-bordered" style="text-align: center">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">{{ __('ID') }}</th>
                            <th scope="col">{{ __('Username') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Email Verified At') }} </th>
                            <th scope="col">{{ __('Roles') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="">
                                    {{ $user->id }}
                                </td>
                                <td class="">
                                    {{ $user->username }}
                                </td>
                                <td class="">
                                    {{ $user->email }}
                                </td>
                                <td class="">
                                    {{ $user->email_verified_at }}
                                </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <button  type="button" class="btn btn-light text-dark btn-sm align-content-center" disabled>{{ $role->title }}</button>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form class="btn p-0" action="{{ route('users.destroy', $user->id) }}"
                                          method="POST" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                    </form>
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
