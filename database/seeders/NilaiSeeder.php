<?php

namespace Database\Seeders;

use App\Models\Akademik;
use App\Models\Data_angkatan;
use App\Models\Detail_jadwal;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapels = Mapel::all();
        $guru_list = Guru::count();

        foreach (Data_angkatan::with('siswa')->get() as $key => $angkatan) {
            $tahun_masuk = $angkatan->tahun_masuk;
            $tahuns = Akademik::where('tahun_ajaran', 'like', $tahun_masuk . '%')->orWhere('tahun_ajaran', 'like', ($tahun_masuk + 1) . '%')->orWhere('tahun_ajaran', 'like', ($tahun_masuk + 2) . '%')->get();

            $counter = 0;
            foreach ($tahuns as $key => $tahun) {
                $kelas_ke = 'X';
                $counter += 1;
                switch ($counter) {
                    case 1:
                    case 2:
                        $kelas_ke = 'X';
                        break;

                    case 3:
                    case 4:
                        $kelas_ke = 'XI';
                        break;

                    case 5:
                    case 6:
                        $kelas_ke = 'XII';
                        break;

                    default:
                        # code...
                        break;
                }
                foreach ($angkatan->siswa as $key => $siswa) {
                    $id_raport_uts = Nilai::create([
                        'jenis_nilai' => 'UTS',
                        'kelas_ke' => $kelas_ke,
                        'id_siswa' => $siswa->id,
                        'id_akademik' => $tahun->id,
                    ])->id;

                    $id_raport_uas = Nilai::create([
                        'jenis_nilai' => 'UAS',
                        'kelas_ke' => $kelas_ke,
                        'sakit' => random_int(1, 10),
                        'izin' => random_int(0, 10),
                        'tanpa_keterangan' => random_int(10, 50),
                        'id_siswa' => $siswa->id,
                        'id_akademik' => $tahun->id,
                    ])->id;
                    foreach ($mapels as $key => $mapel) {
                        DB::table('detail_nilais')->insert([
                            'nilai_akademik' => random_int(50, 100),
                            'id_nilai' => $id_raport_uts,
                            'id_mapel' => $mapel->id,
                            'id_guru' => random_int(1, $guru_list)
                        ]);
                        DB::table('detail_nilais')->insert([
                            'nilai_akademik' => random_int(50, 100),
                            'id_nilai' => $id_raport_uas,
                            'id_mapel' => $mapel->id,
                            'id_guru' => random_int(1, $guru_list)
                        ]);
                    }
                }
            }
        }
    }
}
