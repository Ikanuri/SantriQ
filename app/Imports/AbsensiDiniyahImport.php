<?php

namespace App\Imports;

use App\Models\AbsensiDiniyah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiDiniyahImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AbsensiDiniyah([
            'santri_id'    => $row['santri_id'] ?? null,
            'tanggal'      => $row['tanggal'] ?? null,
            'status'       => $row['status'] ?? null,
        ]);
    }
}
