<?php

namespace App\Exports;

use App\Models\TahunAkademik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TahunAkademikExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TahunAkademik::all(['id', 'tahun', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'tahun',
            'created_at',
            'updated_at',
        ];
    }
}
