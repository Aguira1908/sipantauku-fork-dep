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

    <!-- TOTAL -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg mb-8">

        <h2 class="text-lg opacity-90">
            Total Penerimaan
        </h2>

        <p class="text-4xl font-bold mt-2 tracking-wide">
            Rp {{ number_format($total,0,',','.') }}
        </p>

    </div>

    <!-- CARD -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

@foreach($hasil as $h)

    {{-- =======================
        PAJAK KENDARAAN BERMOTOR
    ======================== --}}
    @if(
        $h['nama'] == 'PKB' ||
        $h['nama'] == 'Pajak Kendaraan Bermotor'
    )

    <div class="group [perspective:1000px]">

        <div class="relative h-80 w-full duration-700 transform-style-preserve-3d group-hover:rotate-y-180">

            <!-- DEPAN -->
            <div class="absolute inset-0 backface-hidden bg-white p-6 rounded-2xl shadow border-l-4 border-green-500">

                <h3 class="text-xl font-bold text-gray-700 mb-4">
                    🚗 Pajak Kendaraan Bermotor
                </h3>

                <p class="text-sm text-gray-500">
                    Realisasi
                </p>

                <p class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($h['total'],0,',','.') }}
                </p>

                <div class="mt-4">

                    <p class="text-sm text-gray-500">
                        Target Tahun {{ $tahun }}
                    </p>

                    <p class="font-semibold">
                        Rp {{ number_format($h['target'],0,',','.') }}
                    </p>

                </div>

                <div class="mt-5">

                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full"
                            style="width: {{ min($h['persen'],100) }}%">
                        </div>

                    </div>

                    <div class="flex justify-between mt-2">

                        <span>Progress</span>

                        <span class="font-bold text-green-700">
                            {{ $h['persen'] }}%
                        </span>

                    </div>

                </div>

                <div class="mt-6 text-center text-xs text-gray-400">
                    Hover untuk melihat detail →
                </div>

            </div>

            <!-- BELAKANG -->
            <div class="absolute inset-0 rotate-y-180 backface-hidden rounded-2xl shadow-xl bg-gradient-to-br from-blue-500 to-cyan-600 text-white p-6 overflow-y-auto">

                <h2 class="text-xl font-bold mb-5">
                    📊 Detail PKB
                </h2>


                <!-- PKB BBN 1 -->
                <div class="bg-white/20 rounded-xl p-4 mb-3">

                    <div class="flex justify-between">

                        <span>
                            🆕 PKB BBN 1
                        </span>

                        <span class="font-bold">
                            Rp {{ number_format($h['pkb_bbn1'] ?? 0,0,',','.') }}
                        </span>

                    </div>

                </div>

                <!-- E-Samsat -->
                <div class="bg-white/20 rounded-xl p-4 mb-3">

                    <div class="flex justify-between">

                        <span>
                            🚘 E-Samsat
                        </span>

                        <span class="font-bold">
                            Rp {{ number_format($h['e_samsat'] ?? 0,0,',','.') }}
                        </span>

                    </div>

                </div>

                <!-- SIGAP -->
                <div class="bg-white/20 rounded-xl p-4 mb-4">

                    <div class="flex justify-between">

                        <span>
                            🚀 SIGAP
                        </span>

                        <span class="font-bold">
                            Rp {{ number_format($h['sigap'] ?? 0,0,',','.') }}
                        </span>

                    </div>

                </div>

                <!-- Total -->
                <div class="bg-white rounded-xl text-gray-800 p-4">

                    <p class="text-sm text-gray-500">
                        Total PKB
                    </p>

                    <p class="text-2xl font-bold text-green-700">
                        Rp {{ number_format($h['total'],0,',','.') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- =======================
        DENDA PKB
    ======================== --}}
    @elseif(
        $h['nama'] == 'Denda PKB' ||
        $h['nama'] == 'Denda Pajak Kendaraan Bermotor'
    )

    <div class="group [perspective:1000px]">

        <div class="relative h-80 w-full duration-700 transform-style-preserve-3d group-hover:rotate-y-180">

            <!-- DEPAN -->
            <div class="absolute inset-0 backface-hidden bg-white p-6 rounded-2xl shadow border-l-4 border-red-500">

                <h3 class="text-xl font-bold text-gray-700 mb-4">
                    🚨 Denda Pajak Kendaraan Bermotor
                </h3>

                <p class="text-sm text-gray-500">
                    Realisasi
                </p>

                <p class="text-2xl font-bold text-red-600">
                    Rp {{ number_format($h['total'],0,',','.') }}
                </p>

                <div class="mt-4">

                    <p class="text-sm text-gray-500">
                        Target Tahun {{ $tahun }}
                    </p>

                    <p class="font-semibold">
                        Rp {{ number_format($h['target'],0,',','.') }}
                    </p>

                </div>

                <div class="mt-5">

                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="bg-gradient-to-r from-red-400 to-red-600 h-3 rounded-full"
                            style="width: {{ min($h['persen'],100) }}%">
                        </div>

                    </div>

                    <div class="flex justify-between mt-2">

                        <span>Progress</span>

                        <span class="font-bold text-red-700">
                            {{ $h['persen'] }}%
                        </span>

                    </div>

                </div>

                <div class="mt-6 text-center text-xs text-gray-400">
                    Hover untuk melihat detail →
                </div>

            </div>

            <!-- BELAKANG -->
            <div class="absolute inset-0 rotate-y-180 backface-hidden rounded-2xl shadow-xl bg-gradient-to-br from-red-500 to-orange-500 text-white p-6 h-80 overflow-y-auto">

                <h2 class="text-xl font-bold mb-5">
                    🚨 Detail Denda PKB
                </h2>

                <!-- Denda PKB BBN 1 -->
                <div class="bg-white/20 rounded-xl p-4 mb-3">
                    <div class="flex justify-between">
                        <span>🆕 Denda PKB BBN 1</span>
                        <span class="font-bold">
                            Rp {{ number_format($h['denda_pkb_bbn1'] ?? 0,0,',','.') }}
                        </span>
                    </div>
                </div>

                <!-- Denda E-Samsat -->
                <div class="bg-white/20 rounded-xl p-4 mb-3">
                    <div class="flex justify-between">
                        <span>🚘 Denda E-Samsat</span>
                        <span class="font-bold">
                            Rp {{ number_format($h['denda_e_samsat'] ?? 0,0,',','.') }}
                        </span>
                    </div>
                </div>

                <!-- Denda SIGAP -->
                <div class="bg-white/20 rounded-xl p-4 mb-4">
                    <div class="flex justify-between">
                        <span>🚀 Denda SIGAP</span>
                        <span class="font-bold">
                            Rp {{ number_format($h['denda_sigap'] ?? 0,0,',','.') }}
                        </span>
                    </div>
                </div>

                <!-- Total -->
                <div class="bg-white rounded-xl text-gray-800 p-4">
                    <p class="text-sm text-gray-500">
                        Total Denda PKB
                    </p>

                    <p class="text-2xl font-bold text-red-700">
                        Rp {{ number_format($h['total'],0,',','.') }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    {{-- =======================
        BAGIAN LAIN
    ======================== --}}
    @else

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition border-l-4 border-green-500">

        <h3 class="text-lg font-bold text-gray-700">
            📁 {{ $h['nama'] }}
        </h3>

        <div class="mt-4">

            <p class="text-sm text-gray-500">
                Realisasi
            </p>

            <p class="text-green-600 font-bold text-xl">
                Rp {{ number_format($h['total'],0,',','.') }}
            </p>

        </div>

        <div class="mt-4">

            <p class="text-sm text-gray-500">
                Target Tahun {{ $tahun }}
            </p>

            <p class="font-semibold">
                Rp {{ number_format($h['target'],0,',','.') }}
            </p>

        </div>

        <div class="mt-5">

            <div class="w-full bg-gray-200 rounded-full h-3">

                <div
                    class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full"
                    style="width: {{ min($h['persen'],100) }}%">
                </div>

            </div>

            <div class="flex justify-between mt-2">

                <span>Progress</span>

                <span class="font-bold text-green-700">
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

<script>

const data = @json($hasil);

new Chart(document.getElementById('chart'), {

    type:'bar',

    data:{

        labels:data.map(d=>d.nama),

        datasets:[

            {

                label:'Realisasi',

                data:data.map(d=>d.total),

                backgroundColor:'rgba(239,68,68,.8)',

                borderRadius:6

            },

            {

                label:'Target Tahun {{ $tahun }}',

                data:data.map(d=>d.target),

                backgroundColor:'rgba(16,185,129,.8)',

                borderRadius:6

            }

        ]

    }

});

</script>

<style>

.transform-style-preserve-3d{

    transform-style:preserve-3d;

}

.backface-hidden{

    backface-visibility:hidden;

}

.rotate-y-180{

    transform:rotateY(180deg);

}

.group:hover .group-hover\:rotate-y-180{

    transform:rotateY(180deg);

}

</style>

</body>
</html>
