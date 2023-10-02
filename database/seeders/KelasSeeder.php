<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelass = ['X', 'XI', 'XII'];
        $jurusans = ['ipa', 'ips'];
        $jumlah_kelas_per_jurusan = ['ipa' => 2, 'ips' => 3];

        $counter = 0;

        foreach ($jurusans as $jurusan) {
            for ($i = 1; $i <= $jumlah_kelas_per_jurusan[$jurusan]; $i++) {
                foreach ($kelass as $kelas) {
                    $kelas_jurusan = $kelas . ' ' . $jurusan . ' ' . $i;
                    $counter += 1;
                    DB::table('kelas')->insert([
                        'nama_kelas' => strtoupper($kelas_jurusan),
                        'id_guru' => $counter
                    ]);
                    DB::table('ruangs')->insert([
                        'nama_ruang' => strtoupper($kelas_jurusan),
                        'luas' => random_int(10, 14),
                        'lokasi' => fake('id_ID')->word(),
                    ]);
                }
            }
        }
    }
}
