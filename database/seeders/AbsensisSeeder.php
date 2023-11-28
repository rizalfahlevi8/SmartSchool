<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\AbsensiTest;
use App\Models\Akademik;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsensisSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = now()->setYear(2023)->setMonth(10)->setDay(1);
        $currentDate = now();

        while ($startDate <= $currentDate) {
            for ($i = 0; $i < 20; $i++) {
                $kelas = fake('id_ID')->randomElement(['siswa', 'guru']);
                $idSiswa = ($kelas == 'siswa') ? random_int(22, 25) : random_int(2, 21);

                DB::table('absensis')->insert([
                    'status_absen' => fake('id_ID')->randomElement(['masuk', 'sakit', 'tidak masuk']),
                    'kelas' => $kelas,
                    'id_siswa' => $idSiswa,
                    'created_at' => $startDate,
                ]);
            }

            $startDate->addDay();
        }
}
}
