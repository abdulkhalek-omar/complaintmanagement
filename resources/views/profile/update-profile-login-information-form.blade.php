<x-jet-form-section submit="updateProfileLoginInformation">
    <x-slot name="title">
        {{ __('Profile Login Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <x-jet-action-message on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <div class="w-md-75">

            <!-- Forename -->
            <div class="mb-3">
                <x-jet-label for="forename" value="{{ __('Forename') }}" />
                <x-jet-input id="forename" type="text" class="{{ $errors->has('forename') ? 'is-invalid' : '' }}" wire:model.defer="state.forename" autocomplete="forename" />
                <x-jet-input-error for="forename" />
            </div>

            <!-- Surname -->
            <div class="mb-3">
                <x-jet-label for="surename" value="{{ __('Surename') }}" />
                <x-jet-input id="surename" type="text" class="{{ $errors->has('surename') ? 'is-invalid' : '' }}" wire:model.defer="state.surename" autocomplete="surename" />
                <x-jet-input-error for="surename" />
            </div>

            <!-- Forename -->
            <div class="mb-3">
                <x-jet-label for="forename" value="{{ __('Forename') }}" />
                <x-jet-input id="forename" type="text" class="{{ $errors->has('forename') ? 'is-invalid' : '' }}" wire:model.defer="state.forename" autocomplete="forename" />
                <x-jet-input-error for="forename" />
            </div>

            <!-- Surname -->
            <div class="mb-3">
                <x-jet-label for="surename" value="{{ __('Surename') }}" />
                <x-jet-input id="surename" type="text" class="{{ $errors->has('surename') ? 'is-invalid' : '' }}" wire:model.defer="state.surename" autocomplete="surename" />
                <x-jet-input-error for="surename" />
            </div>


        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="d-flex align-items-baseline">
            <x-jet-button>
                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Save') }}
            </x-jet-button>
        </div>
    </x-slot>

</x-jet-form-section>
