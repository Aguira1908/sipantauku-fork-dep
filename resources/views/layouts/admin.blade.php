<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="icon" href="{{ asset('world.png') }}" type="image/png">

</head>

<body class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-100 min-h-screen font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gradient-to-b from-emerald-900 via-green-800 to-emerald-700 text-white p-6 shadow-2xl">

        <!-- LOGO -->
        <h2 class="text-2xl font-extrabold mb-10 tracking-wide">
            🌿 Admin Panel
        </h2>

        <!-- MENU -->
        <nav class="space-y-3">

            <a href="/admin"
               class="flex items-center gap-2 p-3 rounded-xl hover:bg-emerald-600 transition shadow-sm hover:shadow-md">
                📊 <span>Dashboard</span>
            </a>

            <a href="/tambah"
               class="flex items-center gap-2 p-3 rounded-xl hover:bg-green-600 transition shadow-sm hover:shadow-md">
                ➕ <span>Tambah Data</span>
            </a>

            <a href="/bagian"
               class="flex items-center gap-2 p-3 rounded-xl hover:bg-teal-600 transition shadow-sm hover:shadow-md">
                📁 <span>Kelola Bagian</span>
            </a>

            <a href="/target"
               class="flex items-center gap-2 p-3 rounded-xl hover:bg-lime-600 transition shadow-sm hover:shadow-md">
                🎯 <span>Kelola Target</span>
            </a>

        </nav>

        <!-- DIVIDER -->
        <div class="border-t border-green-400 my-8 opacity-40"></div>

        <!-- LOGOUT -->
        <form method="POST" action="/logout">
            @csrf
            <button class="w-full bg-red-500 py-2 rounded-xl hover:bg-red-600 transition shadow-md">
                🚪 Logout
            </button>
        </form>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <!-- TOP BAR -->
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-800">
                🌿 Sistem Monitoring Pajak
            </h1>

            <span class="text-gray-500 text-sm">
                {{ date('d M Y') }}
            </span>
        </div>

        <!-- CONTENT CARD WRAPPER -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>
