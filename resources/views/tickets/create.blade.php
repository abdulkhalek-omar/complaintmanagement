<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Submit a complaint') }}
        </h2>
    </x-slot>

    <section class="container  bg-white pt-3 pb-3">
        <div class="col-md-7 col-lg-8">

            <x-jet-validation-errors class="mb-3"/>

            <form method="POST" action="{{ route('tickets.store') }}">
                @csrf

                <div class="col-md-4">
                    <label for="keyword" class="form-label">{{__('Keyword')}}
                        <span class="text-muted">({{__('Optional')}})</span>
                    </label>
                    <select class="form-select" id="keyword" name="id">
                        @foreach($keywords as $keyword)
                            <option value="{{$keyword->id}}">{{__($keyword->keyword)}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                    <label for="state" class="form-label"> {{__('Your Complaint')}}
                        <span class="text-muted">*</span>
                    </label>
                    <div class="form-floating">
                    <textarea class="{{ $errors->has('content') ? 'is-invalid' : '' }} form-control"
                              placeholder="write your complaint here"
                              id="floatingTextarea2"
                              name="content"
                              style="height: 100px"></textarea>
                        <label for="floatingTextarea2">{{__('Your Complaint')}}</label>
                        @error('content')
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
