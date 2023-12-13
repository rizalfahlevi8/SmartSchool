<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithMapping
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Siswa::all();
        
    }

    /**
     * @param mixed $siswa
     * @return array
     */
    public function map($siswa): array
    {
        // Return only the desired columns
        return [
            'username' => $siswa->user->username,
            'email' => $siswa->user->email,
        ];
    }
}

