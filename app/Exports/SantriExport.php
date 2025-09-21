<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SantriExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $columns = [
            'id',
            'kamar_id',
            'nomor_kamar',
            'nama',
            'alamat',
            'tempat_lahir',
            'tanggal_lahir',
            'created_at',
            'updated_at',
        ];
        $data = Santri::all($columns)->toArray();
        return $data;
    }

    public function headings(): array
    {
        return [
            'id',
            'kamar_id',
            'nomor_kamar',
            'nama',
            'alamat',
            'tempat_lahir',
            'tanggal_lahir',
            'created_at',
            'updated_at',
        ];
    }
}
