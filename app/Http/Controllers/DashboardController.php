<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        // DATA SESUAI TAHUN
        $data = Penerimaan::with('bagian')
            ->whereYear('tanggal', $tahun)
            ->get();

        // TOTAL SEMUA PENERIMAAN
        $total = $data->sum('jumlah_uang');

        // TARGET
        $targets = Target::query()
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('bagian_id');

        $hasil = [];

        /** @var Collection $grouped */
        $grouped = $data->groupBy('bagian_id');

        foreach ($grouped as $bagian_id => $items) {

            // TOTAL BAGIAN
            $totalBagian = $items->sum('jumlah_uang');

            // KHUSUS E-SAMSAT
            $eSamsat = $items
                ->where('jenis_input', 'E-Samsat')
                ->sum('jumlah_uang');

            // TARGET
            $target = isset($targets[$bagian_id])
                ? $targets[$bagian_id]->target_uang
                : 0;

            // PERSEN
            $persen = $target > 0
                ? round(($totalBagian / $target) * 100, 2)
                : 0;

            // SIMPAN KE ARRAY
            $hasil[] = [

                'nama' => $items->first()->bagian->nama_bagian,

                'total' => $totalBagian,

                'e_samsat' => $eSamsat,

                'target' => $target,

                'persen' => $persen,

            ];
        }

        return view('dashboard', compact(
            'data',
            'total',
            'hasil',
            'tahun'
        ));
    }
}
