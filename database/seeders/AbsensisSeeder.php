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
    $endDate = now()->subDay(); 

    while ($startDate <= $endDate) {
    
        $usedRandomValues = [];
    
        for ($i = 0; $i < 10; $i++) {
            // Menghasilkan nilai random unik
            $role = fake('id_ID')->randomElement(['siswa', 'guru']);
            
            do {
                $randomValue = ($role == 'siswa') ? random_int(22, 621) : random_int(2, 21);
            } while (in_array($randomValue, $usedRandomValues));
    
            $usedRandomValues[] = $randomValue;
    
            $idUser = $randomValue;
    
            DB::table('absensis')->insert([
                'status_absen' => fake('id_ID')->randomElement(['masuk', 'sakit', 'izin', 'tidak masuk']),
                'role' => $role,
                'id_user' => $idUser,
                'created_at' => $startDate,
            ]);
        }
    
        $startDate->addDay();
    }
}

}
