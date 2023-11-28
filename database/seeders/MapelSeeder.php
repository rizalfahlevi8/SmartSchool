<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapels = ['Bahasa Inggris', 'Bahasa Indonesia', 'Matematika', 'PKN', 'IPS', 'BIOLOGI', 'KIMIA', 'FISIKA'];
        foreach ($mapels as $mapel) {
            DB::table('mapels')->insert([
                'nama_mapel' => $mapel
            ]);
        }
    }
}
