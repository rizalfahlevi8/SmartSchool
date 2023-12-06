<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keteranganabsensi;

class KeteranganabsensiSeeder extends Seeder
{
    public function run()
    {
        $startDate = '2023-10-01';
        $endDate = '2024-01-01';

        $currentDate = $startDate;

        while ($currentDate < $endDate) {
            $dayOfWeek = date('N', strtotime($currentDate));

            if ($dayOfWeek == 6 || $dayOfWeek == 7) { // Saturday or Sunday
                Keteranganabsensi::create([
                    'tanggal' => $currentDate,
                    'status' => 'weekend',
                    'keterangan' => 'akhir pekan',
                ]);
            }

            $currentDate = date('Y-m-d', strtotime($currentDate . ' + 1 day'));
        }
    }
}
