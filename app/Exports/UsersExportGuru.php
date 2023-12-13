<?php

namespace App\Exports;

use App\Models\Guru;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExportGuru implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        // Mengambil data guru dengan informasi user terkait
        $guruData = Guru::with('user')->get();

        // Menggabungkan data guru dengan data user
        $combinedData = $guruData->map(function ($guru) {
            return [
                'firstname' => $guru->nip . ' ' . $guru->nama, // Menggabungkan nip dan nama
                'lastname' => optional($guru->user)->role, // Mengambil role dari model User
                'username' => optional($guru->user)->username,
                'email' => optional($guru->user)->email,
                'password' => 'G123*', // Menambahkan kolom password
            ];
        });

        return $combinedData;
    }

    /**
     * @param mixed $guru
     * @return array
     */
    public function map($guru): array
    {
        // Return hanya kolom yang diinginkan
        return [
            'firstname' => $guru['firstname'],
            'lastname' => $guru['lastname'],
            'username' => $guru['username'],
            'email' => $guru['email'],
            'password' => $guru['password'],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Mengembalikan judul untuk setiap kolom tanpa huruf kapital
        return [
            'firstname',
            'lastname',
            'username',
            'email',
            'password',
        ];
    }
}

