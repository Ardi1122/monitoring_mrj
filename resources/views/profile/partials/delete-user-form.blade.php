<section>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-danger">{{ __('Delete Account') }}</h5>
            <p class="card-text text-muted">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                {{ __('Delete Account') }}
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="deleteAccountModalLabel">{{ __('Are you sure you want to delete your account?') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="text-muted">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div class="mb-3">
                                    <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
