<?php

namespace App\Exports;

use App\Models\TahunAkademik;
use Maatwebsite\Excel\Concerns\FromCollection;

class TahunAkademikExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TahunAkademik::all();
    }
}
