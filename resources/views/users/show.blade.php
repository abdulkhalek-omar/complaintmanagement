<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{__('Show User')}}
        </h2>
    </x-slot>

    <div class="container bg-white pt-3 pb-3 mt-3 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped align-middle bg-white table-bordered">
                        <tr class="bg-light">
                            <th scope="col">
                                ID
                            </th>
                            <td>
                                {{ $user->id }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col">
                                Username
                            </th>
                            <td class="">
                                {{ $user->username }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col">
                                Email
                            </th>
                            <td class="">
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr class="">
                            <th scope="col">
                                Email Verified At
                            </th>
                            <td>
                                {{ $user->email_verified_at }} => {{ $user->email_verified_at->diffForHumans() }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col">
                                Roles
                            </th>
                            <td class="">
                                @foreach ($user->roles as $role)
                                    <span>{{ $role->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr class="">
                            <th scope="col">
                                User has registered at
                            </th>
                            <td>
                                {{ $user->created_at }} => {{ $user->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-info btn-sm">Back to list</a>
    </div>

</x-app-layout>
