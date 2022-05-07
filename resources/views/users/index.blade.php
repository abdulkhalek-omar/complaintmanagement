<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="">
            <div class="">
                <a href="{{ route('users.create') }}"
                   class="btn btn-outline-success mb-3">
                    {{ __('Add User') }}
                </a>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <div class="">
                            <div class="">

                                <table class="table align-middle mb-0 bg-white">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col">{{ __('ID') }}</th>
                                        <th scope="col">{{ __('Username') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Email Verified At') }} </th>
                                        <th scope="col">{{ __('Roles') }}</th>
                                        <th scope="col">

                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
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
                                                    <span class="">
                                                    {{ $role->title }}
                                                </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}" class="">View</a>
                                                <a href="{{ route('users.edit', $user->id) }}" class="">Edit</a>
                                                <form class="" action="{{ route('users.destroy', $user->id) }}"
                                                      method="POST" onsubmit="return confirm('Are you sure?');">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="" value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
