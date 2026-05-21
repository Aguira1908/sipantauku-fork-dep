<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Penerimaan;
use App\Models\Bagian;
use App\Models\Target;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // DATA PENERIMAAN
        $data = Penerimaan::with('bagian')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $total = $data->sum('jumlah_uang');

        $bagian = Bagian::all();

        // TARGET TAHUNAN
        $targets = Target::query()
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('bagian_id');

        $hasil = [];

        foreach ($bagian as $b) {

            $realisasi = $data
                ->where('bagian_id', $b->id)
                ->sum('jumlah_uang');

            $target = isset($targets[$b->id])
                ? $targets[$b->id]->target_uang
                : 0;

            $persen = $target > 0
                ? round(($realisasi / $target) * 100, 2)
                : 0;

            $hasil[] = [
                'nama' => $b->nama_bagian,
                'realisasi' => $realisasi,
                'target' => $target,
                'persen' => $persen,
            ];
        }

        return view('admin.dashboard', compact(
            'data',
            'total',
            'bagian',
            'hasil',
            'bulan',
            'tahun'
        ));
    }
}
