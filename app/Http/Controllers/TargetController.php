<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\Bagian;

class TargetController extends Controller
{
    public function index()
    {
        $data = Target::with('bagian')->latest()->get();
        $bagian = Bagian::all();

        return view('admin.target.index', compact('data', 'bagian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bagian_id' => 'required',
            'tahun' => 'required',
            'target_uang' => 'required|numeric'
        ]);

        Target::create([
            'bagian_id' => $request->bagian_id,
            'tahun' => $request->tahun,
            'target_uang' => $request->target_uang
        ]);

        return redirect('/target')
            ->with('success', 'Target berhasil ditambahkan');
    }

    public function destroy(int $id)
    {
        Target::findOrFail($id)->delete();

        return redirect('/target')
            ->with('success', 'Target berhasil dihapus');
    }
}
