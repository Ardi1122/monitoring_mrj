<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-custom {
            background-color: #e970bb;
        }
        .text-custom {
            color: #e970bb;
        }
        .hover-custom:hover {
            background-color: #d65ba8;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <div class="text-center">
        <!-- Error 404 -->
        <h1 class="text-9xl font-bold text-custom mb-4">404</h1>
        
        <!-- Message -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-500 mb-8">Maaf, halaman yang Anda cari tidak tersedia.</p>
        
        <!-- Button Dashboard -->
        @auth
            @if(auth()->user()->role === 'pengelola')
                <a href="/kader" class="inline-block px-8 py-3 bg-custom text-white rounded-lg font-semibold hover-custom transition duration-300">
                    Kembali ke Dashboard
                </a>
            @elseif(auth()->user()->role === 'dosen')
                <a href="/admin" class="inline-block px-8 py-3 bg-custom text-white rounded-lg font-semibold hover-custom transition duration-300">
                    Kembali ke Dashboard
                </a>
            @elseif(auth()->user()->role === 'ibu_hamil')
                <a href="/ibu-hamil/dashboard" class="inline-block px-8 py-3 bg-custom text-white rounded-lg font-semibold hover-custom transition duration-300">
                    Kembali ke Dashboard
                </a>
            @endif
        @else
            <a href="/" class="inline-block px-8 py-3 bg-custom text-white rounded-lg font-semibold hover-custom transition duration-300">
                Kembali ke Beranda
            </a>
        @endauth
    </div>
</body>
</html>