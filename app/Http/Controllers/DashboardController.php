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

$tanggalMulai = $request->tanggal_mulai;
$tanggalSampai = $request->tanggal_sampai;

// DATA SESUAI TAHUN + RENTANG TANGGAL
$query = Penerimaan::with('bagian')
    ->whereYear('tanggal', $tahun);

// Kalau tanggal mulai diisi
if ($tanggalMulai) {
    $query->whereDate('tanggal', '>=', $tanggalMulai);
}

// Kalau tanggal sampai diisi
if ($tanggalSampai) {
    $query->whereDate('tanggal', '<=', $tanggalSampai);
}

$data = $query->get();

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

            // PKB BBN 1
            $pkbBbn1 = $items
                ->where('jenis_input', 'PKB BBN 1')
                ->sum('jumlah_uang');

            // RELAKSASI PAJAK 2026
            $relaksasiPajak2026 = $items
                ->where('jenis_input', 'Relaksasi Pajak 2026')
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

            // Denda PKB
            $dendaPkb = $items
                ->where('jenis_input', 'Denda PKB')
                ->sum('jumlah_uang');

            // Denda PKB BBN 1
            $dendaPkbBbn1 = $items
                ->where('jenis_input', 'Denda PKB BBN 1')
                ->sum('jumlah_uang');

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
                'pkb_bbn1' => $pkbBbn1,
                'relaksasi_pajak_2026' => $relaksasiPajak2026,
                'e_samsat' => $eSamsat,
                'sigap' => $sigap,

                // DENDA PKB
                'denda_pkb' => $dendaPkb,
                'denda_pkb_bbn1' => $dendaPkbBbn1,
                'denda_e_samsat' => $dendaESamsat,
                'denda_sigap' => $dendaSigap,

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
