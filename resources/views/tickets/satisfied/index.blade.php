<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Post a comment') }}
        </h2>
    </x-slot>

    <section class="container  bg-white pt-3 pb-3">
        <div class="col-md-7 col-lg-8">

            <x-jet-validation-errors class="mb-3"/>

            @include('tickets.satisfied.store')

        </div>


        <div class="mt-2">
            <a href="{{ route('tickets.index') }}" class="btn btn-outline-info btn-sm">{{__('Back to Tickets')}}</a>
        </div>

    </section>

</x-app-layout>
