<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Siswa::class;

    public function definition()
    {
        $faker = app(Faker::class);
        return [
            'no_pendaftar'  => $faker->numberBetween(4),
            'nis'           => $faker->numberBetween(10),
            'nisn'          => $faker->numberBetween(10),
            'nik'           => $faker->numberBetween(16),
            'nama_ayah'     => $faker->name('male'),
            'nama_ibu'      => $faker->name('female'),
            'fullname'      => $faker->name,
            'bakat'         => $faker->sentence,
            'sekolah'       => $faker->randomElement(['SMA 1 Jember', 'SMA 2 Jember', 'SMA 3 Jember', 'SMA 4 Jember', 'SMA 5 Jember']),
            'status'        => 'diterima',
            'alamat'        => $faker->address,
            'bakat'         => $faker->randomElement(['IPA', 'IPS']),
            'kelas_id'      => $faker->randomElement([3,4,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28]),
            'password'      => bcrypt('secret'),
            'foto'          => $faker->randomElement(['siswa1.jpg', 'siswa2.jpg', 'siswa3.jpg']),
            'jk'            => $faker->randomElement(['Perempuan', 'Laki-laki']),
            'agama'         => $faker->randomElement(['Islam', 'Hindu', 'Buddha', 'Kristen']),
            'notelp'        => $faker->phoneNumber








        ];
    }
} 
