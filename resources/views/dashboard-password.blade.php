<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIPANTAUKU | Akses Dashboard</title>

  @vite(['resources/css/app.css'])

  <link href="{{ asset('world.png') }}" rel="icon">
  <script src="https://unpkg.com/feather-icons"></script>

</head>

<body
  class="flex min-h-screen items-center justify-center bg-gradient-to-br from-green-700 via-emerald-600 to-teal-700 p-5">

  <!-- Background Blur -->
  <div class="absolute inset-0 overflow-hidden">

    <div class="absolute -left-20 -top-20 h-96 w-96 rounded-full bg-green-400 opacity-20 blur-3xl"></div>

    <div class="absolute bottom-0 right-0 h-[500px] w-[500px] rounded-full bg-cyan-300 opacity-20 blur-3xl"></div>

  </div>

  <!-- CARD -->
  <div class="relative w-full max-w-md">

    <div class="rounded-3xl bg-white/95 p-10 shadow-2xl backdrop-blur-xl">

      <!-- Logo -->
      <div class="mb-5 flex justify-center">

        <img class="h-20 w-20 drop-shadow-lg" src="{{ asset('world.png') }}">

      </div>

      <!-- Judul -->
      <h1 class="text-center text-3xl font-extrabold text-green-700">

        SIPANTAUKU

      </h1>

      <p class="mt-2 text-center text-gray-500">

        Sistem Informasi Pemantauan Target dan Realisasi Pajak Daerah

      </p>

      <div class="my-6 border-t"></div>

      <h2 class="text-center text-xl font-bold text-gray-700">

        🔒 Dashboard Monitoring

      </h2>

      <p class="mb-6 mt-2 text-center text-sm text-gray-500">

        Masukkan password untuk membuka dashboard.

      </p>

      @if (session('error'))
        <div class="mb-5 rounded-xl border border-red-300 bg-red-100 p-3 text-sm text-red-700">

          {{ session('error') }}

        </div>
      @endif

      <form method="POST">

        @csrf

        <label class="mb-2 block font-semibold text-gray-700">

          Password

        </label>

        <div class="relative">

          <input
            class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500"
            id="password" name="password" placeholder="Masukkan Password" type="password">

          <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-700"
            onclick="togglePassword()" type="button">

            <i data-feather="eye" id="eyeIcon"></i>

          </button>

        </div>

        <button
          class="mt-6 w-full rounded-xl bg-gradient-to-r from-green-600 to-emerald-500 py-3 font-bold text-white shadow-lg transition hover:scale-105 hover:shadow-xl"
          type="submit">

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

    function togglePassword() {

      const password = document.getElementById('password');
      const icon = document.getElementById('eyeIcon');

      if (password.type === "password") {

        password.type = "text";
        icon.setAttribute("data-feather", "eye-off");

      } else {

        password.type = "password";
        icon.setAttribute("data-feather", "eye");

      }

      feather.replace();

    }
  </script>

</body>

</html>
