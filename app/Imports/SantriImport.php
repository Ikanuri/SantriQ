<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SantriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Mapping berdasarkan nama kolom di file Excel/CSV
        return new Santri([
            'kamar_id'      => $row['kamar_id'] ?? null,
            'nomor_kamar'   => $row['nomor_kamar'] ?? null,
            'nama'          => $row['nama'] ?? null,
            'alamat'        => $row['alamat'] ?? null,
            'tempat_lahir'  => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => $row['tanggal_lahir'] ?? null,
        ]);
    }
}
