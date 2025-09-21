<?php

namespace App\Imports;

use App\Models\RayonKamar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RayonKamarImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RayonKamar([
            'nama' => $row['nama'] ?? null,
        ]);
    }
}
