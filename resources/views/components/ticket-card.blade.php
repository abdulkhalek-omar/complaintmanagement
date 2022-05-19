@props(['card', 'color'])

@php
    $card_color               = "text-white bg-dark";
    $btn_color                = "btn btn-secondary";
    $footer_color             = "text-muted";
    $btn_text                 = "Close Ticket";
    $close_open               = 1;
if ($card->closed){
    $card_color               = "text-white bg-success";
    $btn_color                = "btn btn-dark";
    $footer_color             = "text-info";
    $btn_text                 = "Open Ticket";
    $close_open               = 0;
}
@endphp
@canany(['employee_access', 'admin_access'])
    <div class="col-lg-4 mb-5 d-flex align-items-stretch">
        <div class="card {{$card_color}}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{__('Created by')}}
                    : {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
                <p class="card-text mb-4">{!! $card->ticket->content !!}</p>

                <form action="{{ route('tickets.close-open-ticket') }}" method="POST">
                    @csrf
                    <input name="close_open" value="{{ $close_open }}" hidden/>
                    <input name="id" value="{{$card->id}}" hidden/>
                    <button type="submit" class="{{$btn_color . ' mt-auto align-self-start'}}">{{ $btn_text }}</button>
                </form>

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

                @if($close_open == 0)

                    <form action=" {{ route('tickets.satisfied.store') }} " method="POST">
                        @csrf
                        <input name="satisfied" value="0" hidden/>
                        <input name="id" value="{{ $card->id }}" hidden/>
                        <button type="submit" class="form-control btn btn-outline-dark mb-1">
                            {{ __('Satisfied') }}
                        </button>
                    </form>

                    <a href=" {{ route('tickets.satisfied.index', ['id' => $card->id]) }} "
                       class="form-control btn btn-outline-danger" role="button">
                        {{ __('Not Satisfied') }}
                    </a>

                @endif

            </div>
            <div class="card-footer {{$footer_color}}">
                @if($close_open == 1)
                    <div>{{__('Assigned to')}}: {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                    {{__('Assigned at')}}: {{ $card->assignment_at->diffForHumans() }} <br>
                    {{__('Expiry at')}}: {{ $card->expiry_at->diffForHumans($card->assignment_at) }}
                @else
                    {{__('Reply From Employee')}}
                    <div class="mt-2">{{__('Answer from Employee')}}
                        : {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
                @endif
            </div>
        </div>
    </div>
@endcan
