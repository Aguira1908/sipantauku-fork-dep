<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerimaan;
use App\Models\Bagian;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penerimaan::with('bagian');

        // FILTER TANGGAL
        if ($request->dari && $request->sampai) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }

        // FILTER BAGIAN
        if ($request->bagian_id) {
            $query->where('bagian_id', $request->bagian_id);
        }

        $data = $query->latest()->get();
        $total = $data->sum('jumlah_uang');
        $bagian = Bagian::all();

        return view('laporan.index', compact('data', 'total', 'bagian'));
    }

    public function download(Request $request)
    {
        $query = Penerimaan::with('bagian');

        if ($request->dari && $request->sampai) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }

        if ($request->bagian_id) {
            $query->where('bagian_id', $request->bagian_id);
        }

        $data = $query->get();
        $total = $data->sum('jumlah_uang');

        $pdf = Pdf::loadView('laporan.pdf', compact('data', 'total'));

        return $pdf->download('laporan_penerimaan.pdf');
    }
}
