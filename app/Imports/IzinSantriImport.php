<?php

namespace App\Imports;

use App\Models\IzinSantri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IzinSantriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new IzinSantri([
            'santri_id'    => $row['santri_id'] ?? null,
            'tanggal_izin' => $row['tanggal_izin'] ?? null,
            'keterangan'   => $row['keterangan'] ?? null,
        ]);
    }
}
