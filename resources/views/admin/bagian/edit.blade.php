@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto">

    <!-- CARD -->
    <div class="bg-white p-8 rounded-2xl shadow-lg">

        <!-- TITLE -->
        <h2 class="text-2xl font-bold mb-6 text-center text-green-700">
            ✏️ Edit Bagian
        </h2>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form action="/bagian/update/{{ $data->id }}" method="POST">
            @csrf

            <!-- INPUT -->
            <div class="mb-5">
                <label class="block mb-2 text-sm font-semibold text-gray-600">
                    Nama Bagian
                </label>

                <input type="text"
                    name="nama_bagian"
                    value="{{ $data->nama_bagian }}"
                    class="w-full border border-gray-300 p-3 rounded-lg 
                           focus:ring-2 focus:ring-green-400 focus:outline-none 
                           transition"
                    placeholder="Masukkan nama bagian">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between items-center mt-6">

                <!-- BACK -->
                <a href="/bagian"
                   class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow transition">
                    ⬅ Kembali
                </a>

                <!-- UPDATE -->
                <button
                    class="bg-gradient-to-r from-green-500 to-emerald-600 
                           text-white px-5 py-2 rounded-lg shadow 
                           hover:scale-105 transition">
                    💾 Update
                </button>

            </div>

        </form>

    </div>

</div>

@endsection