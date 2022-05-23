<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Post a comment') }}
        </h2>
    </x-slot>

    <section class="container  bg-white pt-3 pb-3">
        <div class="col-md-7 col-lg-8">

            <x-jet-validation-errors class="mb-3"/>

            <form method="POST" action="{{ route('tickets.satisfied.store') }}">
                @csrf
                <input name="id" value="{{ $id }}" hidden/>
                <div class="col-md-12 mt-3">
                    <label for="state" class="form-label"> {{__('Please let us know what you do not like!')}}
                        <span class="text-muted">*</span>
                    </label>
                    <div class="form-floating">
                    <textarea class="{{ $errors->has('comment') ? 'is-invalid' : '' }} form-control"
                              placeholder="write your complaint here"
                              id="floatingTextarea2"
                              name="comment"
                              style="height: 100px"></textarea>
                        <label for="floatingTextarea2">{{__('Your Comment')}}</label>
                        @error('comment')
                        <p class="invalid-feedback" style="display: contents">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">
                <button class="btn btn-outline-secondary btn-lg w-100 " type="submit">
                    {{__('Submit')}}
                </button>
            </form>
        </div>


        <div class="mt-2">
            <a href="{{ route('tickets.index') }}" class="btn btn-outline-info btn-sm">{{__('Back to Tickets')}}</a>
        </div>

    </section>

</x-app-layout>
