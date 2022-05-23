<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Close This Ticket') }}
        </h2>
    </x-slot>

    <section class="container  bg-white pt-3 pb-3">
        <div class="col-md-7 col-lg-8">

            <x-jet-validation-errors class="mb-3"/>

            <form method="POST" action="{{ route('tickets.closeTicket.store') }}">
                @csrf
                <input name="id" value="{{ $id }}" hidden/>

                <!-- Response -->
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="{{ $errors->has('response') ? 'is-invalid' : '' }} form-control"
                                  placeholder="write your response here"
                                  id="floatingTextarea2"
                                  name="response"
                                  style="height: 100px"></textarea>
                        <label for="floatingTextarea2">{{__('Your Response for the Customer')}}</label>
                        @error('response')
                        <p class="invalid-feedback" style="display: contents">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">
                <button class="btn btn-outline-secondary btn-lg w-100" type="submit">
                    {{__('Submit')}}
                </button>

            </form>
        </div>


        <div class="mt-2">
            <a href="{{ route('tickets.index') }}" class="btn btn-outline-info btn-sm">{{__('Back to Tickets')}}</a>
        </div>

    </section>

</x-app-layout>
