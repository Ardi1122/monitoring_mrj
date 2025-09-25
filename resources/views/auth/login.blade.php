<x-guest-layout>
    <!-- Status Session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-center text-[var(--accent-color)] mb-6">Masuk ke Akun</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
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
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--accent-color)] focus:ring-[var(--accent-color)] px-3 py-2"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me + Lupa Password -->
        <div class="flex items-center justify-between">
            <!-- Ingat saya -->
            <label for="remember_me" class="flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    name="remember"
                    class="rounded border-gray-300 text-[var(--accent-color)] shadow-sm focus:ring-[var(--accent-color)]"
                >
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            <!-- Lupa Password -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-[var(--accent-color)] hover:underline">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Tombol Login -->
        <div>
            <button 
                type="submit"
                class="w-full bg-[var(--accent-color)] text-white font-semibold px-5 py-3 rounded-lg shadow-md hover:opacity-90 transition"
                style="background-color: var(--accent-color, #e970bb);"
            >
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </button>
        </div>

        <!-- Link ke Register -->
        @if (Route::has('register'))
            <p class="text-sm text-center mt-4 text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[var(--accent-color)] font-semibold hover:underline">
                    Daftar sekarang
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
