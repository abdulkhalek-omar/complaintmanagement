<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Tickets Management') }}
        </h2>
    </x-slot>

    <a href="{{ route('tickets.create') }}"
       class="btn btn-outline-success mb-3">
        {{ __('Submit a Complaint') }}
    </a>

    <section class="bg-light shadow-sm">

        <div class="container">
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
    </section>


</x-app-layout>
