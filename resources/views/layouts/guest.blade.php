<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('landing_page_mrj/assets/css/main.css') }}">

    <!-- Tambahan untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        
        <!-- Logo -->
        <div class="mb-6 text-center">
            <a href="{{ url('/') }}" class="flex flex-col items-center">
                <img src="{{ asset('landing_page_mrj/assets/img/logo2.png') }}" class="w-20 mb-2" alt="Logo">
                <h1 class="text-2xl font-bold text-[var(--accent-color)]">Ibu Hamil</h1>
            </a>
        </div>

        <!-- Card -->
        <div class="w-full rounded-2xl sm:max-w-md mt-6 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <p class="mt-6 text-sm text-gray-500 text-center">
            © {{ date('Y') }} <span class="text-[var(--accent-color)] font-semibold">{{ config('app.name', 'Laravel') }}</span>. Semua Hak Dilindungi.
        </p>
    </div>
</body>

</html>
