<x-guest-layout>

    <!-- TITLE -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-green-700">
            Daftar Akun
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Buat akun untuk mengakses sistem
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAME -->
        <div>
            <x-input-label for="name" :value="__('Nama')" class="text-gray-700 font-medium" />

            <x-text-input
                id="name"
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="Masukkan nama lengkap"
            />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- EMAIL -->
        <div class="mt-5">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />

            <x-text-input
                id="email"
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="Masukkan email"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />

            <x-text-input
                id="password"
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Masukkan password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-medium" />

            <x-text-input
                id="password_confirmation"
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password"
            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- ACTION -->
        <div class="flex items-center justify-between mt-6">

            <!-- LINK LOGIN -->
            <a class="text-sm text-green-600 hover:text-green-700 hover:underline"
               href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <!-- BUTTON -->
            <button type="submit"
                class="bg-gradient-to-r from-green-500 to-emerald-600 
                       text-white px-6 py-2 rounded-lg shadow-md
                       hover:scale-[1.02] transition font-semibold">
                Daftar
            </button>

        </div>

    </form>

</x-guest-layout>