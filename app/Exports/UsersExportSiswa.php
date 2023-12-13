<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExportSiswa implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        // Mengambil data siswa dengan informasi user terkait
        $siswaData = Siswa::with('user')->get();

        // Menggabungkan data siswa dengan data user
        $combinedData = $siswaData->map(function ($siswa) {
            return [
                'firstname' => $siswa->nisn . ' ' . $siswa->nama, // Menggabungkan nisn dan nama
                'lastname' => optional($siswa->user)->role, // Menambahkan kolom role
                'username' => optional($siswa->user)->username,
                'email' => optional($siswa->user)->email,
                'password' => 'S123*', // Menambahkan kolom password
                // Tambahkan kolom lain yang Anda butuhkan dari model Siswa
            ];
        });

        return $combinedData;
    }

    /**
     * @param mixed $siswa
     * @return array
     */
    public function map($siswa): array
    {
        // Return hanya kolom yang diinginkan
        return [
            'firstname' => $siswa['firstname'],
            'lastname' => $siswa['lastname'],
            'username' => $siswa['username'],
            'email' => $siswa['email'],
            'password' => $siswa['password'],
            // Tambahkan kolom lain yang Anda butuhkan dari model Siswa
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
            // Judul kolom lain yang Anda tambahkan
        ];
    }
}

