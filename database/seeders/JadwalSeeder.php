<?php

namespace Database\Seeders;

use App\Models\Akademik;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfSubjects = Mapel::count();
        $numberOfRooms = Ruang::count();
        $numberOfTeachers = Guru::count();
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $akademik = Akademik::all()->where('tahun_ajaran', '=', now()->year . '/' . now()->year + 1);
        $tahun_akademiks = array();
        foreach ($akademik as $key => $value) {
            array_push($tahun_akademiks, $value->id);
        }

        foreach (Kelas::all() as $kelas) {
            foreach ($days as $day) {
                try {
                    foreach ($tahun_akademiks as $key => $tahun_akademik) {
                        $jadwalId = DB::table('jadwals')->insertGetId([
                            'hari' => $day,
                            'status' => 'masuk',
                            'id_akademik' => $tahun_akademik,
                            'catatan' => 'Tidak Ada',
                            'id_kelas' => $kelas->id
                        ]);

                        for ($hour = 1; $hour <= 4; $hour++) {
                            $startTime = Carbon::createFromTime(6 + $hour, 0, 0);
                            $endTime = $startTime->copy()->addMinutes(45);

                            DB::table('detail_jadwals')->insert([
                                'jam_mulai' => $startTime->format('H:i:s'),
                                'jam_selesai' => $endTime->format('H:i:s'),
                                'keterangan' => 'Tidak Ada',
                                'id_ruang' => random_int(1, $numberOfRooms),
                                'id_guru' => random_int(1, $numberOfTeachers),
                                'id_mapel' => random_int(1, $numberOfSubjects),
                                'id_jadwal' => $jadwalId,
                            ]);
                        }
                    }
                    // ...
                } catch (\Exception $e) {
                    // Tangani kesalahan di sini jika perlu
                    Log::error('Error while seeding: ' . $e->getMessage());
                }
            }
        }
    }
}
