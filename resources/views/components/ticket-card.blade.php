@props(['card', 'color'])

@php
    $card_color               = "text-white bg-dark";
    $btn_color                = "btn btn-secondary";
    $footer_color             = "text-muted";
    $btn_text                 = "Ticket schließen";
if (!$card->closed){
    $card_color               = "text-white bg-success";
    $btn_color                = "btn btn-dark";
    $footer_color             = "text-white";
    $btn_text                 = "Ticket Öffnen";
}
@endphp

<div class="col-lg-4 mb-3 d-flex align-items-stretch">
    <div class="card {{$card_color}}">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">Erstellt von: {{ $card->customer->surname }} {{ $card->customer->firstname }}</h5>
            <p class="card-text mb-4">{!! $card->ticket->content !!}</p>
            <a href="#" class="{{$btn_color . ' mt-auto align-self-start'}}">{{ $btn_text }}</a>
        </div>
        <div class="card-footer {{$footer_color}}">
            <div>Zugewiesen an: {{ $card->employee->surname }} {{ $card->employee->firstname }}</div>
            {{ $card->created_at->diffForHumans() }}
        </div>
    </div>
</div>
