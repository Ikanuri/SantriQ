<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'] ?? null,
            'email'    => $row['email'] ?? null,
            'password' => bcrypt($row['password'] ?? ''),
            'role'     => $row['role'] ?? null,
        ]);
    }
}
