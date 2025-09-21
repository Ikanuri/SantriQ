<?php

namespace App\Exports;

use App\Models\RayonKamar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RayonKamarExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RayonKamar::all(['id', 'nama', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'nama',
            'created_at',
            'updated_at',
        ];
    }
}
