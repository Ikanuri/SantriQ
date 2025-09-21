<?php

namespace App\Imports;

use App\Models\TahunAkademik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TahunAkademikImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TahunAkademik([
            'tahun' => $row['tahun'] ?? null,
        ]);
    }
}
