<?php

namespace Database\Factories;

use App\Models\Pemilik;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemilikFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemilik::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'nik' => "717107".(string)rand(1000000000,9999999999),
        ];
    }
}
