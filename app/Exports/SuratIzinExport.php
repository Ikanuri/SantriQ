<?php

namespace App\Exports;

use App\Models\SuratIzin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuratIzinExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SuratIzin::all(['id', 'nomor_surat', 'santri_id', 'tanggal_izin', 'keterangan', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'nomor_surat',
            'santri_id',
            'tanggal_izin',
            'keterangan',
            'created_at',
            'updated_at',
        ];
    }
}
