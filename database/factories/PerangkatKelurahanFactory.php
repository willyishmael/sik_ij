<?php

namespace Database\Factories;

use App\Models\PerangkatKelurahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerangkatKelurahanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PerangkatKelurahan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'nip' => rand(100000000000,9999999999),
            'email' => $this->faker->safeEmail(),
            'nomor_telepon' => $this->faker->phoneNumber()
        ];
    }
}
