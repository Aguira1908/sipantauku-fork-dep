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

        // TOTAL SELURUH PENERIMAAN
        $total = $data->sum('jumlah_uang');

        // TARGET PER BAGIAN
        $targets = Target::query()
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('bagian_id');

        $hasil = [];

        /** @var Collection $grouped */
        $grouped = $data->groupBy('bagian_id');

        foreach ($grouped as $bagian_id => $items) {

            // ============================
            // TOTAL BAGIAN
            // ============================
            $totalBagian = $items->sum('jumlah_uang');

            // ============================
            // KHUSUS PAJAK KENDARAAN BERMOTOR
            // ============================

            // PKB
            $pkb = $items
                ->where('jenis_input', 'PKB')
                ->sum('jumlah_uang');

            // E-Samsat
            $eSamsat = $items
                ->where('jenis_input', 'E-Samsat')
                ->sum('jumlah_uang');

            // SIGAP
            $sigap = $items
                ->where('jenis_input', 'SIGAP')
                ->sum('jumlah_uang');

            // ============================
            // KHUSUS DENDA PKB
            // ============================

            // Denda E-Samsat
            $dendaESamsat = $items
                ->where('jenis_input', 'Denda E-Samsat')
                ->sum('jumlah_uang');

            // Denda SIGAP
            $dendaSigap = $items
                ->where('jenis_input', 'Denda SIGAP')
                ->sum('jumlah_uang');

            // ============================
            // TARGET
            // ============================

            $target = isset($targets[$bagian_id])
                ? $targets[$bagian_id]->target_uang
                : 0;

            // ============================
            // PERSENTASE
            // ============================

            $persen = $target > 0
                ? round(($totalBagian / $target) * 100, 2)
                : 0;

            // ============================
            // SIMPAN DATA
            // ============================

            $hasil[] = [

                'nama' => $items->first()->bagian->nama_bagian,

                'total' => $totalBagian,

                // PKB
                'pkb' => $pkb,
                'e_samsat' => $eSamsat,
                'sigap' => $sigap,

                // DENDA PKB
                'denda_e_samsat' => $dendaESamsat,
                'denda_sigap' => $dendaSigap,

                // TARGET
                'target' => $target,

                // PERSEN
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
