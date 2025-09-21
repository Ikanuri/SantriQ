<?php

namespace App\Exports;

use App\Models\IzinSantri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IzinSantriExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    return IzinSantri::all(['id', 'santri_id', 'surat_izin_id', 'alasan', 'tanggal_keluar', 'tanggal_kembali', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'santri_id',
            'surat_izin_id',
            'alasan',
            'tanggal_keluar',
            'tanggal_kembali',
            'created_at',
            'updated_at',
        ];
    }
}
