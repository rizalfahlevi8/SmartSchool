<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_angkatan = 4;
        $tahun_mulai = now()->year - ($data_angkatan - 1);

        for ($i = 0; $i < $data_angkatan; $i++) {
            DB::table('data_angkatans')->insert([
                'nama_angkatan' => 'Angkatan ' . $tahun_mulai,
                'tahun_masuk' => $tahun_mulai,
            ]);

            $tahun_counter = $tahun_mulai;
            foreach (['ganjil', 'genap'] as $key => $semester) {
                DB::table('akademiks')->insert([
                    'tahun_ajaran' => $tahun_counter . '/' . $tahun_counter + 1,
                    'semester' => $semester,
                ]);
            }
            $tahun_mulai += 1;
        }


        $currentMonth = date('m'); // Mendapatkan bulan saat ini dalam format numerik (01-12)
        $semester = $currentMonth >= '07' ? 'ganjil' : 'genap';
        $tahun_ajaran = $semester == 'ganjil' ? now()->year . '%' : '%' . now()->year;

        $existingRecord = DB::table('akademiks')->where('tahun_ajaran', 'like', $tahun_ajaran)->where('semester', $semester)->first();

        DB::statement("UPDATE akademiks SET selected = 0");

        if ($existingRecord) {
            // Jika data sudah ada, update 'selected' menjadi $selectedValue
            if ($semester == 'ganjil') {
                DB::table('akademiks')->where('tahun_ajaran', 'like', $tahun_ajaran)->where('semester', '=', $semester)->update(['selected' => 1]);
            } elseif ($semester == 'genap') {
                DB::table('akademiks')->where('tahun_ajaran', 'like', $tahun_ajaran)->where('semester', '=', $semester)->update(['selected' => 1]);
            }
        } else {
            if ($semester == 'ganjil') {
                DB::table('akademiks')->insert([
                    'tahun_ajaran' => now()->year . '/' . now()->year + 1,
                    'semester' => $semester,
                ]);
            } else if ($semester == 'genap') {
                DB::table('akademiks')->insert([
                    'tahun_ajaran' => now()->year - 1 . '/' . now()->year,
                    'semester' => $semester,
                ]);
            }
        }
    }
}
