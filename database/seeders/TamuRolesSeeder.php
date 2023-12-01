<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TamuRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = DB::table('users')->select('role', 'username')->distinct()->get();

        $rolesArray = $roles->pluck('role')->toArray();

        DB::table('tamu_tabel')->truncate();  //menghapus semua data yang ada di tamu_tabel

        foreach ($rolesArray as $role) {
            
            if ($role->role === 'guru') {
                DB::table('tamu_tabel')->insert([
                    'Opsi_Tujuan' => 'Guru',
                    'Keterangan' => 'Role: Guru, Username: ' . $role->username,
                ]);
            } else if ($role->role === 'teknisi') {
                // Tambahkan logika sesuai kebutuhan untuk role 'teknisi'
                // Contoh:
                DB::table('tamu_tabel')->insert([
                    'Opsi_Tujuan' => 'Tambahan untuk Teknisi',
                    'Keterangan' => 'Role: Teknisi, Username: ' . $role->username,
                ]);
            } else if ($role->role === 'siswa') {
                // Tambahkan logika sesuai kebutuhan untuk role 'siswa'
                // Contoh:
                DB::table('tamu_tabel')->insert([
                    'Opsi_Tujuan' => 'Tambahan untuk Siswa',
                    'Keterangan' => 'Role: Siswa, Username: ' . $role->username,
                ]);
            }
        }
    }
}