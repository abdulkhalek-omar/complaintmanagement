<form action=" {{ route('tickets.satisfied.index', ['id' => $card->id]) }} "
      method="GET">
    @csrf
    <button type="submit" class="form-control btn btn-outline-danger">
        {{ __('Not Satisfied') }}
    </button>
</form>
