<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPANTAUKU | Akses Dashboard</title>

    @vite(['resources/css/app.css'])

    <link rel="icon" href="{{ asset('world.png') }}">
    <script src="https://unpkg.com/feather-icons"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-green-700 via-emerald-600 to-teal-700 flex items-center justify-center p-5">

    <!-- Background Blur -->
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute -top-20 -left-20 w-96 h-96 bg-green-400 opacity-20 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-cyan-300 opacity-20 rounded-full blur-3xl"></div>

    </div>

    <!-- CARD -->
    <div class="relative w-full max-w-md">

        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-10">

            <!-- Logo -->
            <div class="flex justify-center mb-5">

                <img src="{{ asset('world.png') }}"
                    class="w-20 h-20 drop-shadow-lg">

            </div>

            <!-- Judul -->
            <h1 class="text-3xl font-extrabold text-center text-green-700">

                SIPANTAUKU

            </h1>

            <p class="text-center text-gray-500 mt-2">

                Sistem Informasi Pemantauan Target dan Realisasi Pajak Daerah

            </p>

            <div class="border-t my-6"></div>

            <h2 class="text-xl font-bold text-center text-gray-700">

                🔒 Dashboard Monitoring

            </h2>

            <p class="text-center text-gray-500 text-sm mt-2 mb-6">

                Masukkan password untuk membuka dashboard.

            </p>

            @if(session('error'))

                <div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-3 mb-5 text-sm">

                    {{ session('error') }}

                </div>

            @endif

            <form method="POST">

                @csrf

                <label class="block mb-2 font-semibold text-gray-700">

                    Password

                </label>

                <div class="relative">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan Password"
                        class="w-full border border-gray-300 rounded-xl py-3 px-4 pr-12 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-700">

                        <i id="eyeIcon" data-feather="eye"></i>

                    </button>

                </div>

                <button
                    type="submit"
                    class="mt-6 w-full bg-gradient-to-r from-green-600 to-emerald-500 text-white py-3 rounded-xl font-bold shadow-lg hover:scale-105 hover:shadow-xl transition">

                    🚀 Masuk Dashboard

                </button>

            </form>

            <div class="mt-8 text-center text-xs text-gray-400">

                © {{ date('Y') }} SIPANTAUKU PPRD Kutai Timur

            </div>

        </div>

    </div>

<script>

feather.replace();

function togglePassword(){

    const password = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');

    if(password.type === "password"){

        password.type = "text";
        icon.setAttribute("data-feather","eye-off");

    }else{

        password.type = "password";
        icon.setAttribute("data-feather","eye");

    }

    feather.replace();

}

</script>

</body>

</html>
