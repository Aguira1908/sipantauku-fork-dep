@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <h1 class="text-3xl font-bold mb-6 text-green-700">
        🎯 Kelola Target
    </h1>

    <!-- FORM -->
    <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">

        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            Tambah Target Baru
        </h2>

        <form action="/target/simpan" method="POST"
            class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf

            <!-- BAGIAN -->
            <select name="bagian_id"
                class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400"
                required>
                <option value="">Pilih Bagian</option>
                @foreach($bagian as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_bagian }}</option>
                @endforeach
            </select>

            <!-- TAHUN -->
            <input type="number" name="tahun"
                class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400"
                placeholder="Tahun" required>

            <!-- TARGET -->
            <input type="number" name="target_uang"
                class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400"
                placeholder="Target Uang" required>

            <!-- BUTTON -->
            <button
                class="bg-gradient-to-r from-green-500 to-emerald-600
                       text-white rounded-lg px-4 py-2 col-span-1 md:col-span-4
                       shadow hover:scale-105 transition">
                ➕ Simpan Target
            </button>

        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            Data Target
        </h2>

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-3 text-left">Bagian</th>
                    <th class="p-3 text-left">Tahun</th>
                    <th class="p-3 text-left">Target</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($data as $d)
                <tr class="border-b hover:bg-green-50 transition">

                    <td class="p-3 font-medium text-gray-700">
                        {{ $d->bagian->nama_bagian }}
                    </td>

                    <td class="p-3">
                        {{ $d->tahun }}
                    </td>

                    <td class="p-3 text-green-600 font-bold">
                        Rp {{ number_format($d->target_uang, 0, ',', '.') }}
                    </td>

                    <td class="p-3 text-center">
                        <a href="/target/hapus/{{ $d->id }}"
                        onclick="return confirm('Hapus target ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow text-sm transition">
                        🗑 Hapus
                        </a>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-5 text-gray-500">
                        Belum ada data target
                    </td>
                </tr>
                @endforelse
                </tbody>

        </table>

    </div>

</div>

@endsection
