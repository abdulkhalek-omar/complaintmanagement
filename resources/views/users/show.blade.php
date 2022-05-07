<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{__('Show User')}}
        </h2>
    </x-slot>

    <div>
        <div class="">
            <a href="{{ route('users.index') }}" class="">Back to list</a>
        </div>

        <table class="">
            <tr class="">
                <th scope="col" class="">
                    ID
                </th>
                <td class="">
                    {{ $user->id }}
                </td>
            </tr>
            <tr class="border-b">
                <th scope="col" class="">
                    Username
                </th>
                <td class="">
                    {{ $user->username }}
                </td>
            </tr>
            <tr class="border-b">
                <th scope="col" class="">
                    Email
                </th>
                <td class="">
                    {{ $user->email }}
                </td>
            </tr>
            <tr class="">
                <th scope="col" class="">
                    Email Verified At
                </th>
                <td class="">
                    {{ $user->email_verified_at }}
                </td>
            </tr>
            <tr class="border-b">
                <th scope="col" class="">
                    Roles
                </th>
                <td class="">
                    @foreach ($user->roles as $role)
                        <span class="">{{ $role->title }}</span>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>

    <div class="">
        <a href="{{ route('users.index') }}" class="">Back to list</a>
    </div>

</x-app-layout>
