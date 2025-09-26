<section>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ __('Profile Information') }}</h5>
            <p class="card-text text-muted">
                {{ __("Update your account's profile information and email address.") }}
            </p>

            {{-- Form untuk verification email --}}
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            {{-- Form update profile --}}
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2 text-warning small">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-link btn-sm p-0">{{ __('Click here to re-send the verification email.') }}</button>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="mt-2 text-success small">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    @endif
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success small ms-2">
                            {{ __('Saved.') }}
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
