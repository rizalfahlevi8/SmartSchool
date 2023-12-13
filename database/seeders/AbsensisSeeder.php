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
    $startDate = now()->setYear(2023)->setMonth(11)->setDay(30);
    $endDate = now()->setYear(2023)->setMonth(12)->setDay(7);

    $userIds = range(2, 143);

    foreach ($userIds as $userId) {
        $role = ($userId >= 2 && $userId <= 21) ? 'guru' : 'siswa';

        while ($startDate <= $endDate) {
            // Pengecekan apakah hari ini bukan Sabtu (6) atau Minggu (7)
            $dayOfWeek = $startDate->dayOfWeek;
            if ($dayOfWeek != 6 && $dayOfWeek != 0) {
                DB::table('absensis')->insert([
                    'status_absen' => fake('id_ID')->randomElement(['masuk', 'sakit', 'izin', 'tidak masuk']),
                    'role' => $role,
                    'id_user' => $userId,
                    'created_at' => $startDate,
                ]);
            }

            $startDate->addDay();
        }

        $startDate->setYear(2023)->setMonth(11)->setDay(30); // Reset start date for the next user
    }
}
}



