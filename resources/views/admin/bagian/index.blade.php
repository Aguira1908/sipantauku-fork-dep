@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-green-800">
        📁 Kelola Bagian
    </h1>
    <p class="text-gray-500 text-sm mt-1">
        Tambah dan kelola bagian penerimaan
    </p>
</div>

<!-- FORM TAMBAH -->
<div class="bg-white p-6 rounded-2xl shadow-lg mb-6">

    <h2 class="font-bold text-green-700 mb-4">
        ➕ Tambah Bagian
    </h2>

    <form action="/bagian/simpan" method="POST" class="flex gap-3 flex-wrap">
        @csrf

        <input type="text" name="nama_bagian"
            class="border border-gray-300 p-2 rounded-lg flex-1 focus:ring-2 focus:ring-green-400 focus:outline-none"
            placeholder="Masukkan nama bagian...">

        <button class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2 rounded-lg shadow hover:scale-105 transition">
            Tambah
        </button>
    </form>

</div>

<!-- TABLE -->
<div class="bg-white p-6 rounded-2xl shadow-lg">

    <h2 class="font-bold text-green-700 mb-4">
        📄 Daftar Bagian
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-3 text-left">Nama Bagian</th>
                    <th class="p-3 text-left w-40">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
            @foreach($data as $d)
            <tr class="border-b hover:bg-green-50 transition">

                <!-- NAMA BAGIAN -->
                <td class="p-3 font-medium text-gray-700">
                    {{ $d->nama_bagian }}
                </td>

                <!-- AKSI -->
                <td class="p-3">
                    <div class="flex gap-2">

                        <!-- EDIT -->
                        <a href="/bagian/edit/{{ $d->id }}"
                        class="px-3 py-1 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg shadow transition">
                        ✏️ Edit
                        </a>

                        <!-- HAPUS -->
                        <a href="/bagian/hapus/{{ $d->id }}"
                        onclick="return confirm('Hapus bagian ini?')"
                        class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
                        🗑 Hapus
                        </a>

                    </div>
                </td>

            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection