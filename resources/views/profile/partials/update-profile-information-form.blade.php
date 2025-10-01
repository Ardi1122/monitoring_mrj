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
            {{-- Form update profile --}}
<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    {{-- Nama --}}
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
               id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- === Tambahan Identitas === --}}
    <div class="mb-3">
        <label for="nik" class="form-label">NIK</label>
        <input type="text" class="form-control" id="nik" name="nik"
               value="{{ old('nik', $user->identitas->nik ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
               value="{{ old('nomor_telepon', $user->identitas->nomor_telepon ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $user->identitas->alamat ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
               value="{{ old('tanggal_lahir', $user->identitas->tanggal_lahir ?? '') }}">
    </div>
    {{-- === End Tambahan Identitas === --}}

    <div class="d-flex align-items-center gap-2">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small ms-2">{{ __('Saved.') }}</span>
        @endif
    </div>
</form>

        </div>
    </div>
</section>
