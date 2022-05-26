<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(!strcmp(session('role'), 'Admin'))
        @if(!is_null($customerNumberChart) ||!is_null($ticketsNumberChart))
            <div>
                {!! $customerNumberChart->container() !!}
                {!! $customerNumberChart->script() !!}
            </div>
            <hr class="my-4">
            <div>
                {!! $ticketsNumberChart->container() !!}
                {!! $ticketsNumberChart->script() !!}
            </div>
        @else
            <div>
                No graphics available
            </div>
        @endif
    @endif

    @if(!strcmp(session('role'), 'Employee'))
        @if(!is_null($openTicketsNumberChart) || !is_null($ticketsAssignedMeChart))
            <div>
                {!! $openTicketsNumberChart->container() !!}
                {!! $openTicketsNumberChart->script() !!}
            </div>
            <hr class="my-4">
            <div>
                {!! $ticketsAssignedMeChart->container() !!}
                {!! $ticketsAssignedMeChart->script() !!}
            </div>
        @else
            <div>
                No graphics available
            </div>
        @endif
    @endif

    @if(!strcmp(session('role'), 'User'))
        @if(!is_null($createdTicketsByCustomerChart) || !is_null($satisfiedTicketsByCustomerChart))
            <div>
                {!! $createdTicketsByCustomerChart->container() !!}
                {!! $createdTicketsByCustomerChart->script() !!}
            </div>
            <hr class="my-4">
            <div>
                {!! $satisfiedTicketsByCustomerChart->container() !!}
                {!! $satisfiedTicketsByCustomerChart->script() !!}
            </div>
        @else
            <div>
                No graphics available
            </div>
        @endif
    @endif

</x-app-layout>
