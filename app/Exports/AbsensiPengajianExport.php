<?php
namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiPengajianExport implements FromCollection
{
    public function collection()
    {
        return Absensi::where('departemen', 'Pengajian')->get();
    }
}
