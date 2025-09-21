<?php

namespace App\Exports;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KamarExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    return Kamar::all(['id', 'rayon_kamar_id', 'jumlah_kamar', 'nama', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'rayon_kamar_id',
            'jumlah_kamar',
            'nama',
            'created_at',
            'updated_at',
        ];
    }
}
