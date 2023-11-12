<?php

namespace Database\Seeders;

use App\Models\Akademik;
use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = Kelas::all();
        $akademik = Akademik::firstWhere('selected', 1);

        foreach ($kelas as $key => $value) {
            foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $key => $hari) {
                Jadwal::create([
                    'status' => 'Libur',
                    'catatan' => 'Tidak Ada',
                    'hari' => $hari,
                    'id_kelas' => $value->id,
                    'id_akademik' => $akademik->id,
                ]);
            }
        }
    }
}
