<form action=" {{ route('tickets.satisfied.update') }} " method="POST">
    @csrf
    <input name="id" value="{{ $card->id }}" hidden/>
    <button type="submit" class="form-control btn btn-outline-dark mb-1">
        {{ __('Satisfied') }}
    </button>
</form>
