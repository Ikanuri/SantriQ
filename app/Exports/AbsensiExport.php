<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Absensi::all(['id', 'santri_id', 'tanggal', 'status', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'santri_id',
            'tanggal',
            'status',
            'created_at',
            'updated_at',
        ];
    }
}
