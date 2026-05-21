<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Bagian;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    // FORM TAMBAH
    public function create()
    {
        $bagian = Bagian::all();

        return view('admin.tambah', compact('bagian'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'bagian_id' => 'required',
            'jumlah_uang' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenis_input' => 'nullable',
        ]);

        Penerimaan::create([
            'bagian_id' => $request->bagian_id,
            'jenis_input' => $request->jenis_input,
            'jumlah_uang' => $request->jumlah_uang,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/admin')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $data = Penerimaan::findOrFail($id);
        $bagian = Bagian::all();

        return view('admin.edit', compact('data', 'bagian'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'bagian_id' => 'required',
            'jumlah_uang' => 'required|numeric',
            'tanggal' => 'required|date',
            'jenis_input' => 'nullable',
        ]);

        $data = Penerimaan::findOrFail($id);

        $data->update([
            'bagian_id' => $request->bagian_id,
            'jenis_input' => $request->jenis_input,
            'jumlah_uang' => $request->jumlah_uang,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/admin')
            ->with('success', 'Data berhasil diupdate');
    }

    // HAPUS
    public function destroy($id)
    {
        $data = Penerimaan::findOrFail($id);

        $data->delete();

        return redirect('/admin')
            ->with('success', 'Data berhasil dihapus');
    }
}
