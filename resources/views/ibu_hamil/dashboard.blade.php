{{-- resources/views/ibu_hamil/dashboard.blade.php --}}
@extends('layouts.ibu_hamil')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold text-pink-600">Dashboard</h1>
    <p>Selamat datang di dashboard {{ Auth::user()->name }} 🎉</p>
</div>
@endsection
