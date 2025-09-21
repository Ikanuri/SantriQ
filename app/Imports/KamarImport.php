<?php

namespace App\Imports;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KamarImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kamar([
            'rayon_id'     => $row['rayon_id'] ?? null,
            'jumlah_kamar' => $row['jumlah_kamar'] ?? null,
            'nama'         => $row['nama'] ?? null,
        ]);
    }
}
