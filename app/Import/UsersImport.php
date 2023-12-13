<?php

namespace App\Import;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'username' => $row['username'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']), // Sesuaikan dengan cara penyimpanan password pada model Anda
        ]);
    }
}