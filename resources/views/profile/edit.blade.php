@extends('layouts.ibu_hamil')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-2xl fw-bold text-pink-600">Profile</h1>

    {{-- Update Profile Information --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Update Password --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Delete User --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
