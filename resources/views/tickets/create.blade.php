<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Submit a complaint') }}
        </h2>
    </x-slot>

    <section class="container  bg-white pt-3 pb-3">
        <div class="col-md-7 col-lg-8">
            <form method="POST" action="{{ route('tickets.store') }}">
                @csrf
                @method('POST')

{{--                <hr class="my-4">--}}

                <div class="col-md-4">
                    <label for="keyword" class="form-label">{{__('Keyword')}} <span class="text-muted">*</span></label>
                    <select class="form-select" id="keyword">
                        <option value="">{{__('Choose')}}...</option>
                        <option>{{__('Technical problem')}} </option>
                        <option>{{__('Malfunction')}}</option>
                        <option>{{__('Accounting')}}</option>
                        <option>{{__('None of them')}}</option>
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                    <label for="state" class="form-label"> {{__('Your Complaint')}}
                        {{--                        <span class="text-muted">({{__('Optional')}})</span>--}}
                        <span class="text-muted">*</span>
                    </label>
                    <div class="form-floating">
                    <textarea class="form-control" placeholder="write your complaint here" id="floatingTextarea2"
                              name="content"
                              style="height: 100px"></textarea>
                        <label for="floatingTextarea2">{{__('Your Complaint')}}</label>
                    </div>
                </div>

                <hr class="my-4">

                <a class="w-100 btn btn-outline-secondary btn-lg" type="submit" href="{{ route('tickets.index') }}">{{__('Submit')}}</a>

            </form>
        </div>


        <div class="mt-2">
            <a href="{{ route('tickets.index') }}" class="btn btn-outline-info btn-sm">{{__('Back to Tickets')}}</a>
        </div>

    </section>

</x-app-layout>
