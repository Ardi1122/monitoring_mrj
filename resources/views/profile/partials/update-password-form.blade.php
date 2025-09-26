<section>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ __('Update Password') }}</h5>
            <p class="card-text text-muted">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="update_password_current_password" name="current_password" autocomplete="current-password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="update_password_password" name="password" autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                    @if (session('status') === 'password-updated')
                        <span class="text-success small ms-2">
                            {{ __('Saved.') }}
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
