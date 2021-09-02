<?php

namespace Database\Factories;

use App\Models\Rumah;
use App\Models\Pemilik;
use Illuminate\Database\Eloquent\Factories\Factory;



class RumahFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rumah::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_rumah' => rand(1,99),
            'pemilik_id' => rand(1,10),
            'lingkungan' => rand(1,15),
            'alamat' => $this->faker->address()
        ];
    }
}
