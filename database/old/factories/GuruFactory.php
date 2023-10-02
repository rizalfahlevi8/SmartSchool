<?php

namespace Database\Factories;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    protected $model = Guru::class;
    public function definition()
    {
        $faker = app(Faker::class);
        return [
            'nip'           => $faker->numberBetween(4),
            'nama'          => $faker->name('male'),
            'password'      => bcrypt('secret'),
            'jk'            =>'Laki-laki',
            'agama'         => $faker->randomElement(['Islam', 'Hindu', 'Buddha', 'Kristen']),
            'notelp'        => $faker->phoneNumber,
            'tempatlahir'   => $faker->randomElement(['Jember', 'Bali', 'Surabaya', 'Malang', 'Bandung']),
            'tgllahir'      => $faker->date(),
            'foto'          => $faker->randomElement(['guru1.jpg', 'guru2.jpg', 'guru3.jpg']),
            'alamat'        => $faker->address
           

        ];
    }
}
