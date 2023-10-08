<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Akademik;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Siswa::get() as $siswa) {
            foreach (Akademik::get() as $key => $akademik) {
                Absensi::create([
                    'status_absen' => $status_absen = fake()->randomElement(['tidak masuk', 'masuk', 'telat', 'izin', 'sakit']),
                    'keterangan' => $status_absen == 'izin' ? 'Acara Keluarga' : '',
                    'kelas' => $siswa->kelas->id,
                    'id_siswa' => $siswa->id,
                    'id_akademik' => $akademik->id,
                ]);
            }
        }
    }
}
