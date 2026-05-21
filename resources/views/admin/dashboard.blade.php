@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">

    <div>
        <h1 class="text-3xl font-extrabold text-green-800">
            📊 Dashboard Admin
        </h1>

        <p class="text-gray-500 text-sm mt-1">
            Monitoring realisasi & target pajak
        </p>
    </div>

    <span class="text-gray-400 text-sm mt-2 md:mt-0">
        {{ date('d M Y') }}
    </span>

</div>

<!-- FILTER -->
<form method="GET"
    class="bg-gradient-to-r from-green-100 to-emerald-100 p-4 rounded-xl shadow mb-6 flex flex-wrap gap-3 items-center">

    <input type="number"
        name="bulan"
        value="{{ $bulan }}"
        class="border border-green-300 p-2 rounded-lg w-24 focus:ring-2 focus:ring-green-400"
        placeholder="Bulan"
        min="1"
        max="12">

    <input type="number"
        name="tahun"
        value="{{ $tahun }}"
        class="border border-green-300 p-2 rounded-lg w-32 focus:ring-2 focus:ring-green-400"
        placeholder="Tahun">

    <button class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
        🔍 Filter
    </button>

</form>

<!-- CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <!-- TOTAL -->
    <div class="bg-gradient-to-r from-emerald-400 to-green-600 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transition">

        <p class="text-sm opacity-90">
            Total Penerimaan
        </p>

        <h2 class="text-3xl font-bold mt-2">
            Rp {{ number_format($total, 0, ',', '.') }}
        </h2>

    </div>

    <!-- TRANSAKSI -->
    <div class="bg-gradient-to-r from-teal-400 to-emerald-600 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transition">

        <p class="text-sm opacity-90">
            Jumlah Transaksi
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $data->count() }}
        </h2>

    </div>

    <!-- BAGIAN -->
    <div class="bg-gradient-to-r from-lime-400 to-green-600 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transition">

        <p class="text-sm opacity-90">
            Jumlah Bagian
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $bagian->count() }}
        </h2>

    </div>

</div>

<!-- GRID -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- CHART -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="font-bold text-green-700 mb-4">
            📈 Perbandingan Target vs Realisasi
        </h2>

        <canvas id="chart"></canvas>

    </div>

    <!-- TABLE -->
    <div class="bg-white p-6 rounded-2xl shadow-lg overflow-auto">

        <h2 class="font-bold text-green-700 mb-4">
            📄 Data Terbaru
        </h2>

        <table class="w-full text-sm">

            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Bagian</th>
                    <th class="p-3 text-left">Jumlah</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($data as $d)

                <tr class="border-b hover:bg-green-50 transition">

                    <!-- TANGGAL -->
                    <td class="p-3">
                        {{ $d->tanggal }}
                    </td>

                    <!-- BAGIAN -->
                    <td class="p-3">

                        @php
                            $namaBagian = $d->bagian->nama_bagian;
                        @endphp

                        {{-- KHUSUS PKB --}}
                        @if($namaBagian == 'PKB')

                            {{-- E-SAMSAT --}}
                            @if($d->jenis_input == 'E-Samsat')

                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold shadow-sm">
                                    🚘 E-Samsat
                                </span>

                            {{-- PKB --}}
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

                    <!-- JUMLAH -->
                    <td class="p-3 text-green-600 font-bold">
                        Rp {{ number_format($d->jumlah_uang, 0, ',', '.') }}
                    </td>

                    <!-- AKSI -->
                    <td class="p-3 space-x-1">

                        <a href="/edit/{{ $d->id }}"
                            class="bg-yellow-400 hover:bg-yellow-500 px-2 py-1 rounded text-white text-xs">
                            Edit
                        </a>

                        <a href="/hapus/{{ $d->id }}"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
                            Hapus
                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- PROGRESS TARGET -->
<div class="bg-white p-6 rounded-2xl shadow-lg mt-6">

    <h2 class="font-bold text-green-700 mb-4">
        🎯 Progress Target per Bagian
    </h2>

    @foreach($hasil as $h)

    <div class="mb-5">

        <div class="flex justify-between text-sm mb-1">

            <span class="font-medium text-gray-700">
                {{ $h['nama'] }}
            </span>

            <span class="font-bold text-green-600">
                {{ $h['persen'] }}%
            </span>

        </div>

        <div class="w-full bg-gray-200 rounded-full h-3">

            <div class="bg-gradient-to-r from-green-400 to-emerald-600 h-3 rounded-full transition-all"
                style="width: {{ $h['persen'] }}%">
            </div>

        </div>

    </div>

    @endforeach

</div>

<!-- CHART -->
<script>

const dataChart = @json($hasil);

new Chart(document.getElementById('chart'), {

    type: 'bar',

    data: {

        labels: dataChart.map(d => d.nama),

        datasets: [

            {
                label: 'Realisasi',
                data: dataChart.map(d => d.realisasi),
                backgroundColor: '#22c55e'
            },

            {
                label: 'Target',
                data: dataChart.map(d => d.target),
                backgroundColor: '#f87171'
            }

        ]
    },

    options: {

        plugins: {
            legend: {
                position: 'bottom'
            }
        },

        responsive: true

    }

});

</script>

@endsection
