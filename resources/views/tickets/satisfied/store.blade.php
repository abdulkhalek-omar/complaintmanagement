<form method="POST" action="{{ route('tickets.notSatisfied.store') }}">
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
