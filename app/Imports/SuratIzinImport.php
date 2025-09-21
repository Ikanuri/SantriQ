<?php

namespace App\Imports;

use App\Models\SuratIzin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SuratIzinImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SuratIzin([
            'nomor_surat'  => $row['nomor_surat'] ?? null,
            'santri_id'    => $row['santri_id'] ?? null,
            'tanggal_izin' => $row['tanggal_izin'] ?? null,
            'keterangan'   => $row['keterangan'] ?? null,
        ]);
    }
}
