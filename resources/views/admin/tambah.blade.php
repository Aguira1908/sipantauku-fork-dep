@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="bg-white p-8 rounded-2xl shadow-lg">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-green-800">
                ➕ Tambah Penerimaan
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Input data penerimaan pajak
            </p>
        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg text-sm">
                ⚠ {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form action="/simpan" method="POST" class="space-y-4">
            @csrf

            <!-- BAGIAN -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Bagian
                </label>

                <select
                    name="bagian_id"
                    id="bagian"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none">

                    <option value="">-- Pilih Bagian --</option>

                    @foreach($bagian as $b)
                        <option value="{{ $b->id }}">
                            {{ $b->nama_bagian }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- JENIS INPUT -->
            <div id="jenis-field" style="display:none;">

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jenis PKB
                </label>

                <select
                    name="jenis_input"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none">

                    <option value="">-- Pilih Jenis --</option>

                    <option value="PKB">
                        Pajak Kendaraan Bermotor
                    </option>

                    <option value="E-Samsat">
                        E-Samsat
                    </option>

                </select>

            </div>

            <!-- JUMLAH -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jumlah Uang
                </label>

                <input
                    type="number"
                    name="jumlah_uang"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Masukkan jumlah uang">
            </div>

            <!-- TANGGAL -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <!-- KETERANGAN -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Opsional..."></textarea>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between items-center pt-4">

                <a href="/admin"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg transition">
                    ⬅ Kembali
                </a>

                <button
                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-2 rounded-lg shadow hover:scale-105 transition">

                    💾 Simpan

                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>

document.addEventListener('DOMContentLoaded', function () {

    const bagian = document.getElementById('bagian');

    const jenisField =
        document.getElementById('jenis-field');

    function checkBagian() {

        let selectedText =
            bagian.options[bagian.selectedIndex].text;

        if(
            selectedText === 'PKB' ||
            selectedText === 'Pajak Kendaraan Bermotor') {

            jenisField.style.display = 'block';

        } else {

            jenisField.style.display = 'none';

        }
    }

    checkBagian();

    bagian.addEventListener('change', checkBagian);

});

</script>

@endsection
