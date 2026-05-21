<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penerimaan</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ asset('world.png') }}" type="image/png">
</head>

<body class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-100 min-h-screen p-8 font-sans">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-extrabold text-green-800">
                📊 Laporan Penerimaan
            </h1>
            <p class="text-gray-500 mt-1">
                Filter data & download laporan
            </p>
        </div>

        <a href="/"
           class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
            ⬅ Kembali
        </a>
    </div>

    <!-- FILTER -->
    <form method="GET" action="/laporan"
        class="bg-white p-5 rounded-2xl shadow mb-6 grid md:grid-cols-4 gap-4">

        <input type="date" name="dari" value="{{ request('dari') }}"
            class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400">

        <input type="date" name="sampai" value="{{ request('sampai') }}"
            class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400">

        <select name="bagian_id"
            class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400">
            <option value="">Semua Bagian</option>
            @foreach($bagian as $b)
                <option value="{{ $b->id }}"
                    {{ request('bagian_id') == $b->id ? 'selected' : '' }}>
                    {{ $b->nama_bagian }}
                </option>
            @endforeach
        </select>

        <button class="bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700 transition shadow">
            🔍 Filter
        </button>
    </form>

    <!-- ACTION BAR -->
    <div class="flex justify-between items-center mb-6 flex-wrap gap-3">

        <!-- DOWNLOAD -->
        <a href="/laporan/download?dari={{ request('dari') }}&sampai={{ request('sampai') }}&bagian_id={{ request('bagian_id') }}"
           class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2 rounded-xl shadow hover:scale-105 transition">
            ⬇ Download PDF
        </a>

        <!-- TOTAL -->
        <div class="bg-gradient-to-r from-green-400 to-emerald-600 text-white px-6 py-3 rounded-xl shadow">
            Total:
            <span class="font-bold text-lg">
                Rp {{ number_format($total, 0, ',', '.') }}
            </span>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Bagian</th>
                    <th class="p-4 text-left">Keterangan</th>
                    <th class="p-4 text-left">Jumlah</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($data as $d)
                <tr class="border-b hover:bg-green-50 transition">
                    <td class="p-4">
                        {{ date('d-m-Y', strtotime($d->tanggal)) }}
                    </td>

                    <td class="p-4">

                        @php
                            $namaBagian = $d->bagian->nama_bagian;
                        @endphp

                        {{-- KHUSUS PKB --}}
                        @if($namaBagian == 'PKB')

                            {{-- E-SAMSAT --}}
                            @if($d->jenis_input == 'E-Samsat')

                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold shadow-sm">
                                    🚘 E-Samsat (PKB)
                                </span>

                            {{-- PKB BIASA --}}
                            @else

                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold shadow-sm">
                                    🚗 PKB
                                </span>

                            @endif

                        {{-- BAGIAN LAIN --}}
                        @else

                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold shadow-sm">
                                📁 {{ $namaBagian }}
                            </span>

                        @endif

                    </td>

                    <td class="p-4 text-gray-600">
                        {{ $d->keterangan ?? '-' }}
                    </td>

                    <td class="p-4 text-green-600 font-bold">
                        Rp {{ number_format($d->jumlah_uang, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500">
                        Tidak ada data ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

</body>
</html>
