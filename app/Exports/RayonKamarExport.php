<?php

namespace App\Exports;

use App\Models\RayonKamar;
use Maatwebsite\Excel\Concerns\FromCollection;

class RayonKamarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RayonKamar::all();
    }
}
