<?php

namespace App\Imports;

use App\Models\IzinSantri;
use Maatwebsite\Excel\Concerns\ToModel;

class IzinSantriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new IzinSantri([
            //
        ]);
    }
}
