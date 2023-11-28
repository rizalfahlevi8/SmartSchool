<?php

namespace Database\Seeders;

use App\Models\Data_angkatan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru = 20;
        $siswa_per_kelas = 10;
        for ($i = 2; $i <= $guru + 1; $i++) {
            DB::table('users')->insert([
                'username' => fake('id_ID')->unique()->userName(),
                'email' => fake('id_ID')->unique()->email(),
                'password' => bcrypt('guru'),
                'role' => 'guru',
                'remember_token' => Str::random(20)
            ]);
            DB::table('gurus')->insert([
                'nip' => random_int(10000, 59999) . '' . random_int(10000, 59999),
                'nama' => fake('id_ID')->name(),
                'no_telp' => fake('id_ID')->phoneNumber(),
                'jenis_kelamin' => fake('id_ID')->randomElement(['laki-laki', 'perempuan']),
                'agama' => fake('id_ID')->randomElement(['islam', 'kristen', 'hindu', 'konghucu', 'buddha']),
                'tempat_lahir' => fake('id_ID')->citySuffix(),
                'tanggal_lahir' => fake('id_ID')->date('Y-m-d', 'now'),
                'foto' => 'default_img.png',
                'signature' => 'default_signature.png',
                'alamat' => fake('id_ID')->city(),
                'deleted' => 0,
                'id_user' => $i,
            ]);
        }

        $this->call(KelasSeeder::class);

        foreach (Data_angkatan::all() as $key => $angkatan) {
            foreach (Kelas::all() as $key => $kelas) {
                for ($i = 0; $i < $siswa_per_kelas; $i++) {
                    $id_user = User::create([
                        'username' => fake('id_ID')->unique()->userName(),
                        'email' => fake('id_ID')->unique()->email(),
                        'password' => bcrypt('siswa'),
                        'role' => 'siswa',
                        'remember_token' => Str::random(20)
                    ])->id;
                    DB::table('siswas')->insert([
                        'nis' => random_int(60000, 99999) . '' . random_int(100, 999) . $angkatan->id . $kelas->id . $i,
                        'nisn' => random_int(60000, 99999) . '' . random_int(60000, 99999) . $angkatan->id . $kelas->id . $i,
                        'nik' => random_int(90000, 99999) . '' . random_int(90000, 99999) . '' . random_int(1, 1000) . $angkatan->id . $kelas->id,
                        'nama' => fake('id_ID')->name(),
                        'no_telp' => fake('id_ID')->phoneNumber(),
                        'nama_ayah' => $ayah = fake('id_ID')->name('male'),
                        'nama_ibu' => fake('id_ID')->name('female'),
                        'nama_wali' => $ayah,
                        'status' => fake('id_ID')->randomElement(['bukan pindahan', 'pindahan', 'lulus', 'mutasi']),
                        'tanggal_lahir' => fake('id_ID')->date(),
                        'tempat_lahir' => fake('id_ID')->citySuffix(),
                        'alamat' => fake('id_ID')->city(),
                        'jenis_kelamin' => fake('id_ID')->randomElement(['laki-laki', 'perempuan']),
                        'agama' => fake('id_ID')->randomElement(['islam', 'kristen', 'hindu', 'buddha', 'konghucu']),
                        'id_kelas' => $kelas->id,
                        'id_angkatan' => $angkatan->id,
                        'id_user' => $id_user
                    ]);
                }
            }
        }

        foreach (Data_angkatan::all() as $key => $angkatan) {
            $tahun_masuk = $angkatan->tahun_masuk;
            if ((now()->year - $tahun_masuk) >= 3) {
                DB::select("UPDATE siswas SET siswas.status = 'lulus' WHERE id_angkatan = ?", [$angkatan->id]);
            }
        }
    }
}
