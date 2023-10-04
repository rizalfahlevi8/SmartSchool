<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Ruang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah_barang = 4;
        for ($i = 1; $i <= Ruang::count(); $i++) {
            for ($j = 0; $j < $jumlah_barang; $j++) {
                DB::table('barangs')->insert([
                    'nama_barang' => fake('id_ID')->word(),
                    'tahun_pengadaan' => fake('id_ID')->year(),
                    'jenis' => fake('id_ID')->word(),
                    'jumlah_seluruh_barang' => random_int(50, 100),
                    'id_ruang' => $i,
                ]);
            }
        }
    }
}
