<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'nama' => $faker->name(),
            'gender' => Arr::random(['L', 'P']),
            'nim' => mt_rand(00000001, 99999999),
            'alamat' => $faker->city(),
        ];
    }
}
