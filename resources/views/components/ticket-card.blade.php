@props(['card', 'color'])

@php
    $card_color               = "text-white bg-dark";
    $btn_color                = "btn btn-outline-secondary";
    $footer_color             = "text-muted";
    $btn_text                 = "Close Ticket";
if ($card->closed){
    $card_color               = "text-white bg-success";
    $btn_color                = "btn btn-outline-dark";
    $footer_color             = "text-info";
    $btn_text                 = "Open Ticket";
}
@endphp

@canany(['employee_access', 'admin_access'])
    <div class="col-lg-4 mb-5 d-flex align-items-stretch">
        <div class="card {{$card_color}}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{__('Created by')}}
                    : {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
                <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                @if($card->closed)
                <form action="{{ route('tickets.openTicket') }}" method="POST">
                    @csrf
                    <input name="id" value="{{$card->id}}" hidden/>
                    <button type="submit" class="{{$btn_color . ' mt-auto align-self-start form-control'}}">{{ __($btn_text) }}</button>
                </form>
                @endif

                @if(!$card->closed)
                    <form action="{{ route('tickets.closeTicket.index', ['id' => $card->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="{{$btn_color . ' mt-auto align-self-start form-control'}}">{{ __($btn_text) }}</button>
                    </form>
                @endif

                @can('admin_access')

                    <form action="{{ route('tickets.assign.index', ['employee_id' => $card->employee->id, 'id' => $card->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-outline-light mb-1 mt-2 form-control">
                            {{ __('Assigning the ticket to a Employee or another Employee') }}
                        </button>
                    </form>
                @endcan

            </div>
            <div class="card-footer {{$footer_color}}">
                <div>{{__('Assigned to')}}: {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
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

                @if($card->closed)

                    <form action=" {{ route('tickets.satisfied.store') }} " method="POST">
                        @csrf
                        <input name="satisfied" value="0" hidden/>
                        <input name="id" value="{{ $card->id }}" hidden/>
                        <button type="submit" class="form-control btn btn-outline-dark mb-1">
                            {{ __('Satisfied') }}
                        </button>
                    </form>


                    <form action=" {{ route('tickets.satisfied.index', ['id' => $card->id]) }} " method="GET">
                        @csrf
                        <button type="submit" class="form-control btn btn-outline-danger">
                            {{ __('Not Satisfied') }}
                        </button>
                    </form>

                @endif

            </div>
            <div class="card-footer {{$footer_color}}">
                @if(!$card->closed)
                    <div>{{__('Assigned to')}}: {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                    {{__('Assigned at')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                    {{__('Expiry at')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                @else
                    {{__($card->response)}}
                    <div class="mt-2">{{__('Answer from Employee')}}
                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                @endif
            </div>
        </div>
    </div>
@endcan
