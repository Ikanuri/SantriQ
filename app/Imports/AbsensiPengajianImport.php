<?php

namespace App\Imports;

use App\Models\AbsensiPengajian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiPengajianImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AbsensiPengajian([
            'santri_id'    => $row['santri_id'] ?? null,
            'tanggal'      => $row['tanggal'] ?? null,
            'status'       => $row['status'] ?? null,
        ]);
    }
}
