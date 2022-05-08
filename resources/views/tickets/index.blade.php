<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <section class="bg-light shadow-sm">
        <div class="container" style="margin-left: 8%">
            <div class="row pt-5">
                <div class="col-12">
                    <h3 class="text-uppercase border-bottom mb-4">Verwaltung von Tickets</h3>
                </div>
            </div>
            <div class="row">
                @foreach($cards as $card)
                    @if($card->closed)
                        <x-ticket-card :card="$card" />
                    @else
                        <x-ticket-card :card="$card"/>

                    @endif
                @endforeach

            </div>
        </div>
    </section>


</x-app-layout>
