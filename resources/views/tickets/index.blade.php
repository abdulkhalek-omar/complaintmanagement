<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Tickets Management') }}
        </h2>
    </x-slot>

    @cannot('employee_access')
        <div class="container bg-white pt-3 pb-3 mb-5">
            <div class="row">

                <div class="col-lg-4">
                    <a href="{{ route('tickets.create') }}"
                       class="btn btn-outline-success mb-3">
                        {{ __('Submit a Complaint') }}
                    </a>
                </div>

                <div class="col-lg-4">

                </div>


            </div>
        </div>
    @endcan

    <div class="container bg-light">
        <div class="row">
            @foreach($cards as $card)
                @if($card->closed)
                    <x-ticket-card :card="$card"/>
                @else
                    <x-ticket-card :card="$card"/>
                @endif
            @endforeach
        </div>
    </div>

</x-app-layout>
