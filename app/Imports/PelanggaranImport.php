<?php

namespace App\Imports;

use App\Models\Pelanggaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelanggaranImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pelanggaran([
            'nama' => $row['nama'] ?? null,
        ]);
    }
}
