<x-guest-layout>
    <h2 class="text-2xl font-bold text-center text-[var(--accent-color)] mb-6">Buat Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--accent-color)] focus:ring-[var(--accent-color)] px-3 py-2"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="username"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--accent-color)] focus:ring-[var(--accent-color)] px-3 py-2"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--accent-color)] focus:ring-[var(--accent-color)] px-3 py-2"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--accent-color)] focus:ring-[var(--accent-color)] px-3 py-2"
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Tombol Register -->
        <div>
            <button 
                type="submit"
                class="w-full bg-[var(--accent-color)] text-white font-semibold px-5 py-3 rounded-lg shadow-md hover:opacity-90 transition"
                style="background-color: var(--accent-color, #e970bb);"
            >
                <i class="fas fa-user-plus mr-2"></i> Daftar
            </button>
        </div>

        <!-- Link ke Login -->
        <p class="text-sm text-center mt-4 text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[var(--accent-color)] font-semibold hover:underline">
                Masuk di sini
            </a>
        </p>
    </form>
</x-guest-layout>
