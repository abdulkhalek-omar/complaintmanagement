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

    <section class="mb-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-4">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item active" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">


                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Dropdown Example
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HTML</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
                        </ul>
                    </div>


                </div>

            </div>
        </div>
    </section>


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
