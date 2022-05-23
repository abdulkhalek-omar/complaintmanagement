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
                    @php
                        $card_color               = "text-white bg-success";
                        $btn_color                = "btn btn-outline-dark";
                        $footer_color             = "text-info";
                        $btn_text                 = "Open Ticket";
                    @endphp

                    @canany(['employee_access', 'admin_access'])
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card {{$card_color}}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{__('Created by')}}
                                        : {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                                    <form action="{{ route('tickets.openTicket') }}" method="POST">
                                        @csrf
                                        <input name="id" value="{{$card->id}}" hidden/>
                                        <button type="submit"
                                                class="{{$btn_color . ' mt-auto align-self-start form-control'}}">{{ __($btn_text) }}</button>
                                    </form>

                                    @can('admin_access')

                                        <form
                                            action="{{ route('tickets.assign.index', ['employee_id' => $card->employee->id, 'id' => $card->id]) }}"
                                            method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-light mb-1 mt-2 form-control">
                                                {{ __('Assigning the ticket to a Employee or another Employee') }}
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                                <div class="card-footer {{$footer_color}}">
                                    <div>{{__('Assigned to')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                    {{__('Assigned at')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                                    {{__('Expiry at')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                                </div>
                            </div>
                        </div>

                    @elsecan('user_access')
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card {{$card_color}}">
                                <div class="card-body d-flex flex-column">
                                    {{--                <h5 class="card-title">{{__('Created by')}}: {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>--}}
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>


                                    <form action=" {{ route('tickets.satisfied.store') }} " method="POST">
                                        @csrf
                                        <input name="satisfied" value="0" hidden/>
                                        <input name="id" value="{{ $card->id }}" hidden/>
                                        <button type="submit" class="form-control btn btn-outline-dark mb-1">
                                            {{ __('Satisfied') }}
                                        </button>
                                    </form>


                                    <form action=" {{ route('tickets.satisfied.index', ['id' => $card->id]) }} "
                                          method="GET">
                                        @csrf
                                        <button type="submit" class="form-control btn btn-outline-danger">
                                            {{ __('Not Satisfied') }}
                                        </button>
                                    </form>

                                </div>
                                <div class="card-footer {{$footer_color}}">
                                    {{__($card->response)}}
                                    <div class="mt-2">{{__('Answer from Employee')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                </div>
                            </div>
                        </div>
                    @endcan

                @else
                    @php
                        $card_color               = "text-white bg-dark";
                        $btn_color                = "btn btn-outline-secondary";
                        $footer_color             = "text-muted";
                        $btn_text                 = "Close Ticket";
                    @endphp

                    @canany(['employee_access', 'admin_access'])
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card {{$card_color}}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{__('Created by')}}
                                        : {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                                    <form action="{{ route('tickets.closeTicket.index', ['id' => $card->id]) }}"
                                          method="GET">
                                        @csrf
                                        <button type="submit"
                                                class="{{$btn_color . ' mt-auto align-self-start form-control'}}">{{ __($btn_text) }}</button>
                                    </form>

                                    @can('admin_access')
                                        <form
                                            action="{{ route('tickets.assign.index', ['employee_id' => $card->employee->id, 'id' => $card->id]) }}"
                                            method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-light mb-1 mt-2 form-control">
                                                {{ __('Assigning the ticket to a Employee or another Employee') }}
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                                <div class="card-footer {{$footer_color}}">
                                    <div>{{__('Assigned to')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                    {{__('Assigned at')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                                    {{__('Expiry at')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                                </div>
                            </div>
                        </div>

                    @elsecan('user_access')
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card {{$card_color}}">
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>
                                </div>
                                <div class="card-footer {{$footer_color}}">
                                    <div>{{__('Assigned to')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                    {{__('Assigned at')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                                    {{__('Expiry at')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                                </div>
                            </div>
                        </div>
                    @endcan
                @endif
            @endforeach
        </div>
    </div>

</x-app-layout>
