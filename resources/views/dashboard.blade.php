<!DOCTYPE html>
<html>

<head>
  <title>Dashboard Sipantauku</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link href="{{ asset('world.png') }}" rel="icon" type="image/png">

</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-green-50 to-teal-100 p-6 font-sans">

  <div class="mx-auto max-w-7xl">

    <!-- HEADER -->
    <div class="mb-8 flex items-center justify-between">

      <div>

        <h1 class="text-4xl font-extrabold text-green-800">
          📊 SIPANTAUKU PPRD KUTAI TIMUR
        </h1>

        <p class="mt-1 text-gray-600">
          Monitoring realisasi vs target per bagian
        </p>

      </div>

      <a class="rounded-xl bg-gradient-to-r from-green-600 to-emerald-500 px-5 py-2 text-white shadow transition hover:scale-105"
        href="/laporan">

        📄 Laporan

      </a>

    </div>

    <!-- FILTER -->
    <form class="mb-6 flex flex-wrap gap-4 rounded-xl bg-white p-4 shadow" method="GET">

      <!-- TAHUN -->
      <div>
        <label class="mb-1 block text-sm font-semibold text-gray-600">
          Tahun
        </label>

        <input class="rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-green-400" name="tahun"
          placeholder="Tahun" type="number" value="{{ $tahun }}">
      </div>

      <!-- TANGGAL MULAI -->
      <div>
        <label class="mb-1 block text-sm font-semibold text-gray-600">
          Dari Tanggal
        </label>

        <input class="rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-green-400" name="tanggal_mulai"
          type="date" value="{{ $tanggal_mulai ?? '' }}">
      </div>

      <!-- TANGGAL AKHIR -->
      <div>
        <label class="mb-1 block text-sm font-semibold text-gray-600">
          Sampai Tanggal
        </label>

        <input class="rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-green-400" name="tanggal_sampai"
          type="date" value="{{ $tanggal_sampai ?? '' }}">
      </div>

      <!-- BUTTON -->
      <div class="flex items-end gap-2">

        <button class="rounded-lg bg-green-600 px-5 py-2 text-white shadow transition hover:bg-green-700">
          🔍 Filter
        </button>

        <a class="rounded-lg bg-gray-400 px-5 py-2 text-white transition hover:bg-gray-500" href="/dashboard">
          ↻ Reset
        </a>

      </div>

    </form>

    <!-- TOTAL -->
    <div class="mb-8 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-white shadow-lg">

      <h2 class="text-lg opacity-90">
        Total Penerimaan
      </h2>

      <p class="mt-2 text-4xl font-bold tracking-wide">
        Rp {{ number_format($total, 0, ',', '.') }}
      </p>

    </div>

    <!-- CARD -->
    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">

      @foreach ($hasil as $h)
        {{-- =======================
        PAJAK KENDARAAN BERMOTOR
    ======================== --}}
        @if ($h['nama'] == 'PKB' || $h['nama'] == 'Pajak Kendaraan Bermotor')
          <div class="group [perspective:1000px]">

            <div class="transform-style-preserve-3d group-hover:rotate-y-180 relative h-[450px] w-full duration-700">

              <!-- DEPAN -->
              <div class="backface-hidden absolute inset-0 rounded-2xl border-l-4 border-green-500 bg-white p-6 shadow">

                <h3 class="mb-4 text-xl font-bold text-gray-700">
                  🚗 Pajak Kendaraan Bermotor
                </h3>

                <p class="text-sm text-gray-500">
                  Realisasi
                </p>

                <p class="text-2xl font-bold text-green-600">
                  Rp {{ number_format($h['total'], 0, ',', '.') }}
                </p>

                <div class="mt-4">
                  <p class="text-sm text-gray-500">
                    Target Tahun {{ $tahun }}
                  </p>

                  <p class="font-semibold">
                    Rp {{ number_format($h['target'], 0, ',', '.') }}
                  </p>
                </div>

                <div class="mt-5">

                  <div class="h-3 w-full rounded-full bg-gray-200">

                    <div class="h-3 rounded-full bg-gradient-to-r from-green-400 to-green-600"
                      style="width: {{ min($h['persen'], 100) }}%">
                    </div>

                  </div>

                  <div class="mt-2 flex justify-between">

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
              <div
                class="rotate-y-180 backface-hidden absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 p-6 text-white shadow-xl">

                <h2 class="mb-5 text-xl font-bold">
                  📊 Detail PKB
                </h2>


                <!-- PKB BBN 1 -->
                <div class="mb-3 rounded-xl bg-white/20 p-4">

                  <div class="flex justify-between">

                    <span>
                      🆕 PKB BBN 1
                    </span>

                    <span class="font-bold">
                      Rp {{ number_format($h['pkb_bbn1'] ?? 0, 0, ',', '.') }}
                    </span>

                  </div>

                </div>


                <!-- E-Samsat -->
                <div class="mb-3 rounded-xl bg-white/20 p-4">

                  <div class="flex justify-between">

                    <span>
                      🚘 E-Samsat
                    </span>

                    <span class="font-bold">
                      Rp {{ number_format($h['e_samsat'] ?? 0, 0, ',', '.') }}
                    </span>

                  </div>

                </div>


                <!-- SIGAP -->
                <div class="mb-3 rounded-xl bg-white/20 p-4">

                  <div class="flex justify-between">

                    <span>
                      🚀 SIGAP
                    </span>

                    <span class="font-bold">
                      Rp {{ number_format($h['sigap'] ?? 0, 0, ',', '.') }}
                    </span>

                  </div>

                </div>


                <!-- RELAKSASI PAJAK 2026 -->
                <div class="mb-3 rounded-xl bg-white/20 p-4">

                  <div class="flex justify-between gap-3">

                    <span>
                      🎁 Relaksasi Pajak 2026
                    </span>

                    <span class="whitespace-nowrap font-bold">
                      Rp {{ number_format($h['relaksasi_pajak_2026'] ?? 0, 0, ',', '.') }}
                    </span>

                  </div>

                </div>


                <!-- TOTAL -->
                <div class="rounded-xl bg-white p-4 text-gray-800">

                  <p class="text-sm text-gray-500">
                    Total PKB
                  </p>

                  <p class="text-2xl font-bold text-green-700">
                    Rp {{ number_format($h['total'], 0, ',', '.') }}
                  </p>

                </div>

              </div>

            </div>

          </div>



          {{-- =======================
        DENDA PKB
    ======================== --}}
        @elseif($h['nama'] == 'Denda PKB' || $h['nama'] == 'Denda Pajak Kendaraan Bermotor')
          <div class="group [perspective:1000px]">

            <div class="transform-style-preserve-3d group-hover:rotate-y-180 relative h-80 w-full duration-700">

              <!-- DEPAN -->
              <div class="backface-hidden absolute inset-0 rounded-2xl border-l-4 border-red-500 bg-white p-6 shadow">

                <h3 class="mb-4 text-xl font-bold text-gray-700">
                  🚨 Denda Pajak Kendaraan Bermotor
                </h3>

                <p class="text-sm text-gray-500">
                  Realisasi
                </p>

                <p class="text-2xl font-bold text-red-600">
                  Rp {{ number_format($h['total'], 0, ',', '.') }}
                </p>

                <div class="mt-4">

                  <p class="text-sm text-gray-500">
                    Target Tahun {{ $tahun }}
                  </p>

                  <p class="font-semibold">
                    Rp {{ number_format($h['target'], 0, ',', '.') }}
                  </p>

                </div>

                <div class="mt-5">

                  <div class="h-3 w-full rounded-full bg-gray-200">

                    <div class="h-3 rounded-full bg-gradient-to-r from-red-400 to-red-600"
                      style="width: {{ min($h['persen'], 100) }}%">
                    </div>

                  </div>

                  <div class="mt-2 flex justify-between">

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
              <div
                class="rotate-y-180 backface-hidden absolute inset-0 h-80 overflow-y-auto rounded-2xl bg-gradient-to-br from-red-500 to-orange-500 p-6 text-white shadow-xl">

                <h2 class="mb-5 text-xl font-bold">
                  🚨 Detail Denda PKB
                </h2>

                <!-- Denda PKB BBN 1 -->
                <div class="mb-3 rounded-xl bg-white/20 p-4">
                  <div class="flex justify-between">
                    <span>🆕 Denda PKB BBN 1</span>
                    <span class="font-bold">
                      Rp {{ number_format($h['denda_pkb_bbn1'] ?? 0, 0, ',', '.') }}
                    </span>
                  </div>
                </div>

                <!-- Denda E-Samsat -->
                <div class="mb-3 rounded-xl bg-white/20 p-4">
                  <div class="flex justify-between">
                    <span>🚘 Denda E-Samsat</span>
                    <span class="font-bold">
                      Rp {{ number_format($h['denda_e_samsat'] ?? 0, 0, ',', '.') }}
                    </span>
                  </div>
                </div>

                <!-- Denda SIGAP -->
                <div class="mb-4 rounded-xl bg-white/20 p-4">
                  <div class="flex justify-between">
                    <span>🚀 Denda SIGAP</span>
                    <span class="font-bold">
                      Rp {{ number_format($h['denda_sigap'] ?? 0, 0, ',', '.') }}
                    </span>
                  </div>
                </div>

                <!-- Total -->
                <div class="rounded-xl bg-white p-4 text-gray-800">
                  <p class="text-sm text-gray-500">
                    Total Denda PKB
                  </p>

                  <p class="text-2xl font-bold text-red-700">
                    Rp {{ number_format($h['total'], 0, ',', '.') }}
                  </p>
                </div>

              </div>

            </div>

          </div>

          {{-- =======================
        BAGIAN LAIN
    ======================== --}}
        @else
          <div class="rounded-2xl border-l-4 border-green-500 bg-white p-6 shadow transition hover:shadow-xl">

            <h3 class="text-lg font-bold text-gray-700">
              📁 {{ $h['nama'] }}
            </h3>

            <div class="mt-4">

              <p class="text-sm text-gray-500">
                Realisasi
              </p>

              <p class="text-xl font-bold text-green-600">
                Rp {{ number_format($h['total'], 0, ',', '.') }}
              </p>

            </div>

            <div class="mt-4">

              <p class="text-sm text-gray-500">
                Target Tahun {{ $tahun }}
              </p>

              <p class="font-semibold">
                Rp {{ number_format($h['target'], 0, ',', '.') }}
              </p>

            </div>

            <div class="mt-5">

              <div class="h-3 w-full rounded-full bg-gray-200">

                <div class="h-3 rounded-full bg-gradient-to-r from-green-400 to-green-600"
                  style="width: {{ min($h['persen'], 100) }}%">
                </div>

              </div>

              <div class="mt-2 flex justify-between">

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
    <div class="rounded-2xl bg-white p-6 shadow-lg">

      <h2 class="mb-4 font-bold text-gray-700">

        📈 Perbandingan Target vs Realisasi

      </h2>

      <canvas id="chart"></canvas>

    </div>

  </div>

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

            backgroundColor: 'rgba(239,68,68,.8)',

            borderRadius: 6

          },

          {

            label: 'Target Tahun {{ $tahun }}',

            data: data.map(d => d.target),

            backgroundColor: 'rgba(16,185,129,.8)',

            borderRadius: 6

          }

        ]

      }

    });
  </script>

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
