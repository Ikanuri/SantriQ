<?php

namespace App\Exports;

use App\Models\IzinSantri;
use Maatwebsite\Excel\Concerns\FromCollection;

class IzinSantriExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IzinSantri::all();
    }
}
