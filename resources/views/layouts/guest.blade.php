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

    <link rel="icon" href="{{ asset('world.png') }}" type="image/png">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    <!-- BACKGROUND -->
    <div class="min-h-screen flex flex-col justify-center items-center
                bg-gradient-to-br from-emerald-100 via-green-50 to-teal-200">

        <!-- LOGO -->
        <div class="mb-6 text-center">
            <a href="/" class="flex flex-col items-center">

                <h1 class="text-xl font-bold text-green-700">
                    UPTD PPRD KUTAI TIMUR
                </h1>

                <p class="text-sm text-gray-500">
                    Sistem Monitoring Target & Realisasi
                </p>

            </a>
        </div>

        <!-- CARD -->
        <div class="w-full sm:max-w-md px-8 py-6
                    bg-white/90 backdrop-blur-md
                    shadow-xl rounded-2xl border border-white/40">

            {{ $slot }}

        </div>

        <!-- FOOTER -->
        <p class="mt-6 text-sm text-gray-500">
            © {{ date('Y') }} Sistem Pajak
        </p>

    </div>

</body>
</html>
