<?php

namespace App\Imports;

use App\Models\PelanggaranSantri;
use Maatwebsite\Excel\Concerns\ToModel;

class PelanggaranSantriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PelanggaranSantri([
            //
        ]);
    }
}
