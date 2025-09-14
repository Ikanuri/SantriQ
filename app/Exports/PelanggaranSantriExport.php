<?php

namespace App\Exports;

use App\Models\PelanggaranSantri;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelanggaranSantriExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PelanggaranSantri::all();
    }
}
