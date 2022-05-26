<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Post a comment') }}
        </h2>
    </x-slot>

    <section class="container  bg-white pt-3 pb-3">
        <div class="col-md-7 col-lg-8">

            <x-jet-validation-errors class="mb-3"/>

            <form method="POST" action="{{ route('tickets.assign.store') }}">
                @csrf
                <input name="id" value="{{ $id }}" hidden/>

                <!-- Employee -->
                <div class="mb-3">
                    <x-jet-label for="employee_id" value="{{ __('Employee') }}"/>
                    <select class="form-select" id="employee_id" name="employee_id">
                        @foreach($employees as $employee)
                            <option
                                value="{{__($employee->id)}}"
                                @isset($employee_id)
                                    @if($employee->id == $employee_id) selected @endif>
                                @endisset
                                {{__($employee->surname)}} {{__($employee->firstname)}}
                            </option>
                        @endforeach
                    </select>
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
