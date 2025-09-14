<?php

namespace App\Exports;

use App\Models\SuratIzin;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratIzinExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SuratIzin::all();
    }
}
