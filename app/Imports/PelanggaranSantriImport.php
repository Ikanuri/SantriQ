<?php

namespace App\Imports;

use App\Models\PelanggaranSantri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelanggaranSantriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PelanggaranSantri([
            'santri_id'      => $row['santri_id'] ?? null,
            'pelanggaran_id' => $row['pelanggaran_id'] ?? null,
            'tanggal'        => $row['tanggal'] ?? null,
            'keterangan'     => $row['keterangan'] ?? null,
        ]);
    }
}
