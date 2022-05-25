<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(!strcmp(session('role'), 'Admin'))
        <div>
            {!! $customerNumberChart->container() !!}
            {!! $customerNumberChart->script() !!}
        </div>

        <hr class="my-4">

        <div>
            {!! $ticketsNumberChart->container() !!}
            {!! $ticketsNumberChart->script() !!}
        </div>
    @endif

    @if(!strcmp(session('role'), 'Employee'))
        <div>
            {!! $openTicketsNumberChart->container() !!}
            {!! $openTicketsNumberChart->script() !!}
        </div>
        <hr class="my-4">
        <div>
            {!! $ticketsAssignedMeChart->container() !!}
            {!! $ticketsAssignedMeChart->script() !!}
        </div>
    @endif

    @if(!strcmp(session('role'), 'User'))
        <x-jet-welcome/>
    @endif

</x-app-layout>
