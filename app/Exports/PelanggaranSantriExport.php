<?php

namespace App\Exports;

use App\Models\PelanggaranSantri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelanggaranSantriExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PelanggaranSantri::all(['id', 'santri_id', 'pelanggaran_id', 'tanggal', 'keterangan', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'santri_id',
            'pelanggaran_id',
            'tanggal',
            'keterangan',
            'created_at',
            'updated_at',
        ];
    }
}
