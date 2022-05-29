<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(!strcmp(session('role'), 'Admin'))

        <div class="card-group justify-content-center">
            <div class="card text-white bg-primary mb-3 me-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fa fa-solid fa-users fa-2x"></i> Number of Customer</div>
                <div class="card-body">
                    <h5 class="card-title">{{$numberOfCustomer}}</h5>
                    <p class="card-text">All Customer who are in the system </p>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3 me-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fas fa-users-cog fa-2x"></i> Number of Employee</div>
                <div class="card-body">
                    <h5 class="card-title">{{$numberOfEmployee}}</h5>
                    <p class="card-text">All employees in the application</p>
                </div>
            </div>
            <div class="card text-white bg-success mb-3 me-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fa fa-solid fa-user-secret fa-2x"></i> Number of Admin</div>
                <div class="card-body">
                    <h5 class="card-title">{{$numberOfAdmin}}</h5>
                    <p class="card-text">All admin in the application</p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-3 me-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fa fas fa-id-card-alt fa-2x"></i> Number of Tickets</div>
                <div class="card-body">
                    <h5 class="card-title">{{$numberOfTickets}}</h5>
                    <p class="card-text">All tickets that have been created</p>
                </div>
            </div>
        </div>

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
