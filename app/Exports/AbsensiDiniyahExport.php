<?php
namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiDiniyahExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Asumsikan model Absensi punya relasi ke Santri dan TahunAkademik
        return Absensi::where('departemen', 'Diniyah')
            ->get()
            ->map(function($absensi) {
                return [
                    'id' => $absensi->id,
                    'nama_santri' => $absensi->santri->nama ?? '',
                    'jumlah_hadir' => $absensi->jumlah_hadir ?? '',
                    'jumlah_izin' => $absensi->jumlah_izin ?? '',
                    'jumlah_sakit' => $absensi->jumlah_sakit ?? '',
                    'jumlah_alpha' => $absensi->jumlah_alpha ?? '',
                    'tahun_akademik' => $absensi->tahunAkademik->tahun ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'id',
            'nama santri',
            'jumlah hadir',
            'jumlah izin',
            'jumlah sakit',
            'jumlah alpha',
            'tahun akademik',
        ];
    }
}
