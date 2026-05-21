<x-guest-layout>
    <!-- STATUS -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- TITLE -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-green-700">
            🔐 Login Admin
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Silakan masuk untuk mengelola dashboard
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- EMAIL -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-600 mb-1">
                Email
            </label>

            <input id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan email"
                class="w-full border border-gray-300 rounded-lg p-3
                       focus:ring-2 focus:ring-green-400 focus:outline-none
                       transition">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-600 mb-1">
                Password
            </label>

            <input id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                class="w-full border border-gray-300 rounded-lg p-3
                       focus:ring-2 focus:ring-green-400 focus:outline-none
                       transition">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- REMEMBER -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                    name="remember">

                <span class="ms-2 text-sm text-gray-600">
                    Remember me
                </span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-green-600 hover:text-green-700">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-green-500 to-emerald-600
                   text-white py-3 rounded-lg font-semibold shadow
                   hover:scale-105 transition">
            🚀 Log In
        </button>
    </form>
</x-guest-layout>