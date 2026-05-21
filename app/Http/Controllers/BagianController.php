<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;

class BagianController extends Controller
{
    // LIST DATA
    public function index()
    {
        $data = Bagian::all();
        return view('admin.bagian.index', compact('data'));
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama_bagian' => 'required'
        ]);

        Bagian::create([
            'nama_bagian' => $request->nama_bagian
        ]);

        return redirect('/bagian')->with('success', 'Data berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $data = Bagian::findOrFail($id);
        return view('admin.bagian.edit', compact('data'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bagian' => 'required'
        ]);

        $data = Bagian::findOrFail($id);
        $data->update([
            'nama_bagian' => $request->nama_bagian
        ]);

        return redirect('/bagian')->with('success', 'Data berhasil diupdate');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        Bagian::findOrFail($id)->delete();

        return redirect('/bagian')->with('success', 'Data berhasil dihapus');
    }
}