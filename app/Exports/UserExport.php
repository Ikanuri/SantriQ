<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all(['id', 'name', 'email', 'role', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'role',
            'created_at',
            'updated_at',
        ];
    }
}
