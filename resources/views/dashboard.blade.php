<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Sipantauku</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="icon" href="{{ asset('world.png') }}" type="image/png">

</head>

<body class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-100 min-h-screen p-6 font-sans">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-extrabold text-green-800">
                📊 SIPANTAUKU PPRD KUTAI TIMUR
            </h1>

            <p class="text-gray-600 mt-1">
                Monitoring realisasi vs target per bagian
            </p>

        </div>

        <a href="/laporan"
           class="bg-gradient-to-r from-green-600 to-emerald-500 text-white px-5 py-2 rounded-xl shadow hover:scale-105 transition">

            📄 Laporan

        </a>

    </div>

    <!-- FILTER -->
    <form method="GET"
        class="flex flex-wrap gap-4 mb-6 bg-white p-4 rounded-xl shadow">

        <input
            type="number"
            name="tahun"
            value="{{ $tahun }}"
            class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400"
            placeholder="Tahun">

        <button
            class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition shadow">

            Filter

        </button>

    </form>

    <!-- TOTAL CARD -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg mb-8">

        <h2 class="text-lg opacity-90">
            Total Penerimaan
        </h2>

        <p class="text-4xl font-bold mt-2 tracking-wide">
            Rp {{ number_format($total,0,',','.') }}
        </p>

    </div>

    <!-- CARD PER BAGIAN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    @foreach($hasil as $h)

        {{-- KHUSUS PKB --}}
        @if(
             $h['nama'] == 'PKB' ||
             $h['nama'] == 'Pajak Kendaraan Bermotor'
        )

        <div class="group [perspective:1000px]">

            <div class="relative h-72 w-full duration-700 transform-style-preserve-3d group-hover:rotate-y-180">

                <!-- DEPAN -->
                <div class="absolute inset-0 backface-hidden bg-white p-6 rounded-2xl shadow hover:shadow-xl transition border-l-4 border-green-500">

                    <div class="flex justify-between items-center">

                        <h3 class="text-lg font-bold text-gray-700">
                            🚗 Pajak Kendaraan Bermotor
                        </h3>

                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                            Front
                        </span>

                    </div>

                    <div class="mt-4 space-y-1">

                        <p class="text-sm text-gray-500">
                            Realisasi
                        </p>

                        <p class="text-green-600 font-bold text-lg">
                            Rp {{ number_format($h['total'],0,',','.') }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Target Tahun {{ $tahun }}
                        </p>

                        <p class="text-gray-800 font-semibold">
                            Rp {{ number_format($h['target'],0,',','.') }}
                        </p>

                    </div>

                    <!-- PROGRESS -->
                    <div class="mt-4">

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div class="h-3 rounded-full bg-gradient-to-r from-green-400 to-emerald-600 transition-all duration-500"
                                style="width: {{ $h['persen'] }}%">
                            </div>

                        </div>

                        <div class="flex justify-between mt-1 text-sm">

                            <span class="text-gray-500">
                                Progress
                            </span>

                            <span class="font-semibold text-green-700">
                                {{ $h['persen'] }}%
                            </span>

                        </div>

                    </div>

                    <div class="mt-5 text-xs text-gray-400 text-center">
                        Hover untuk lihat E-Samsat ↻
                    </div>

                </div>

                <!-- BELAKANG -->
                <div class="absolute inset-0 rotate-y-180 backface-hidden bg-gradient-to-br from-blue-500 to-cyan-500 text-white p-6 rounded-2xl shadow-xl">

                    <div class="flex justify-between items-center">

                        <h3 class="text-lg font-bold">
                            🚘 E-Samsat
                        </h3>

                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">
                            Back
                        </span>

                    </div>

                    <div class="mt-4 space-y-1">

                        <p class="text-sm opacity-80">
                            Realisasi E-Samsat
                        </p>

                        <p class="font-bold text-2xl">
                            Rp {{ number_format($h['e_samsat'] ?? 0,0,',','.') }}
                        </p>

                        <p class="text-sm opacity-80 mt-3">
                            Bagian dari total PKB
                        </p>

                    </div>

                    <div class="mt-6 bg-white/20 rounded-xl p-4">

                        <p class="text-sm">
                            Data E-Samsat tetap dihitung ke total PKB   
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- BAGIAN LAIN --}}
        @else

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition border-l-4 border-green-500">

            <h3 class="text-lg font-bold text-gray-700">
                📁 {{ $h['nama'] }}
            </h3>

            <div class="mt-4 space-y-1">

                <p class="text-sm text-gray-500">
                    Realisasi
                </p>

                <p class="text-green-600 font-bold text-lg">
                    Rp {{ number_format($h['total'],0,',','.') }}
                </p>

                <p class="text-sm text-gray-500">
                    Target Tahun {{ $tahun }}
                </p>

                <p class="text-gray-800 font-semibold">
                    Rp {{ number_format($h['target'],0,',','.') }}
                </p>

            </div>

            <!-- PROGRESS -->
            <div class="mt-4">

                <div class="w-full bg-gray-200 rounded-full h-3">

                    <div class="h-3 rounded-full bg-gradient-to-r from-green-400 to-emerald-600 transition-all duration-500"
                        style="width: {{ $h['persen'] }}%">
                    </div>

                </div>

                <div class="flex justify-between mt-1 text-sm">

                    <span class="text-gray-500">
                        Progress
                    </span>

                    <span class="font-semibold text-green-700">
                        {{ $h['persen'] }}%
                    </span>

                </div>

            </div>

        </div>

        @endif

    @endforeach

    </div>

    <!-- CHART -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="font-bold text-gray-700 mb-4">
            📈 Perbandingan Target vs Realisasi
        </h2>

        <canvas id="chart"></canvas>

    </div>

</div>

<!-- CHART -->
<script>

const data = @json($hasil);

new Chart(document.getElementById('chart'), {

    type: 'bar',

    data: {

        labels: data.map(d => d.nama),

        datasets: [

            {
                label: 'Realisasi',
                data: data.map(d => d.total),
                backgroundColor: 'rgba(239, 68, 68, 0.8)',
                borderRadius: 6
            },

            {
                label: 'Target Tahun {{ $tahun }}',
                data: data.map(d => d.target),
                backgroundColor: 'rgba(16,185,129,0.8)',
                borderRadius: 6
            }

        ]

    },

    options: {

        responsive: true,

        plugins: {
            legend: {
                position: 'bottom'
            }
        },

        scales: {
            y: {
                beginAtZero: true
            }
        }

    }

});

</script>

<!-- FLIP CARD CSS -->
<style>

.transform-style-preserve-3d {
    transform-style: preserve-3d;
}

.backface-hidden {
    backface-visibility: hidden;
}

.rotate-y-180 {
    transform: rotateY(180deg);
}

.group:hover .group-hover\:rotate-y-180 {
    transform: rotateY(180deg);
}

</style>

</body>
</html>
