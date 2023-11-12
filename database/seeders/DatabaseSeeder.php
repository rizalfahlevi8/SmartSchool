<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Daftar_pengajar;
use App\Models\Detail_jadwal;
use App\Models\Detail_nilai;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Lupa_password;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Ruang;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AdminSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(AngkatanSeeder::class);
        $this->call(UserSeeder::class);
        // jadwal dummy
        $this->call(JadwalSeeder::class);
        // jadwal kosong
        // $this->call(JadwalSeeder2::class);
        // $this->call(NilaiSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(PeminjamanSeeder::class);
    }
}
