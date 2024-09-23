<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Pelanggaran;
use App\Models\PelanggaranSantri;
use App\Models\RayonKamar;
use App\Models\Santri;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $rayonKamar = RayonKamar::count();
        $kamar = Kamar::count();
        $pengguna = User::count();
        $santri = Santri::count();
        $topSantriPelanggar = $this->topSantriPelanggar();
        return view('index', compact('rayonKamar', 'kamar', 'pengguna', 'santri', 'topSantriPelanggar'));
    }
    public function pelanggaranBulanan()
    {
        // $table->foreignIdFor(Santri::class)->constrained()->cascadeOnDelete();
        // $table->foreignIdFor(Pelanggaran::class)->constrained()->cascadeOnDelete();
        // $table->integer('jumlah');
        // ambil data jumlah pelanggaran santri dari column jumlah dari table pelanggaran_santris 
        $pelanggaran = PelanggaranSantri::selectRaw('SUM(jumlah) as jumlah, MONTH(created_at) as bulan')
            ->groupBy('bulan')
            ->get();
        $hasil = [];
        // Isi array dengan data dari query
        foreach ($pelanggaran as $item) {
            $hasil[$item->bulan] = $item->jumlah;
        }
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            if (!isset($hasil[$bulan])) {
                $hasil[$bulan] = 0;
            }
        }
        ksort($hasil);
        return response()->json($hasil);
    }
    public function persentasePelanggaran()
    {
        $totalPelanggaran = PelanggaranSantri::count();
        $totalSantri = Santri::count();
        return response()->json([
            $totalPelanggaran,
            $totalSantri - $totalPelanggaran,
        ]);
    }
    public function topSantriPelanggar()
    {
        $pelanggaran = PelanggaranSantri::selectRaw('SUM(jumlah) as jumlah, santri_id')
            ->groupBy('santri_id')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->with('santri')
            ->get();
        return $pelanggaran;
    }
}
