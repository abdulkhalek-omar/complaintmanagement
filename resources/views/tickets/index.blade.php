<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Tickets Management') }}
        </h2>
    </x-slot>

    @cannot('employee_access')
                <div class="col-lg-4">
                    <a href="{{ route('tickets.create') }}"
                       class="btn btn-outline-success mb-3">
                        {{ __('Submit a Complaint') }}
                    </a>
                </div>
    @endcan


    <div class="container bg-light">
        <div class="row">
            @foreach($cards as $card)

                @if($card->closed)
                    @canany(['employee_access', 'admin_access'])
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card text-white bg-success">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{__('Created by')}}
                                        : {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                                    <form action="{{ route('tickets.openTicket') }}" method="POST">
                                        @csrf
                                        <input name="id" value="{{$card->id}}" hidden/>
                                        <button type="submit"
                                                class="btn btn-outline-dark mt-auto align-self-start form-control">{{ __('Open Ticket') }}</button>
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
                                <div class="card-footer text-info">
                                    <div>{{__('Assigned to')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                    {{__('Assigned')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                                    {{__('Expiration')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                                </div>
                            </div>
                        </div>

                    @elsecan('user_access')
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card text-white bg-success">
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                                    @include('tickets.satisfied.update')

                                    @include('tickets.satisfied.get')

                                </div>
                                <div class="card-footer text-info">
                                    {{__($card->response)}}
                                    <div class="mt-2">{{__('Answer from Employee')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                </div>
                            </div>
                        </div>
                    @endcan

                @else
                    @canany(['employee_access', 'admin_access'])
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card text-white bg-dark">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{__('Created by')}}
                                        : {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                                    <form action="{{ route('tickets.closeTicket.index', ['id' => $card->id]) }}"
                                          method="GET">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-outline-secondary mt-auto align-self-start form-control">{{ __('Close Ticket') }}</button>
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
                                <div class="card-footer text-muted">
                                    <div>{{__('Assigned to')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                    {{__('Assigned')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                                    {{__('Expiration')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                                </div>
                            </div>
                        </div>

                    @elsecan('user_access')
                        <div class="col-lg-4 mb-5 d-flex align-items-stretch">
                            <div class="card text-white bg-dark">
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text mb-4">{!! $card->ticket->content !!}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    <div>{{__('Assigned to')}}
                                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                                    {{__('Assigned')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                                    {{__('Expiration')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                                </div>
                            </div>
                        </div>
                    @endcan
                @endif
            @endforeach
        </div>
    </div>

</x-app-layout>
