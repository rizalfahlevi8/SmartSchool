<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import namespace Str

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => '12345',
            'email' => 'admin@polije.ac.co.id',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'remember_token' => Str::random(20)
        ]);
    }
}
