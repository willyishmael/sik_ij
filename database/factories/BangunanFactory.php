<?php

namespace Database\Factories;

use App\Models\Bangunan;
use App\Models\Pemilik;
use Illuminate\Database\Eloquent\Factories\Factory;



class BangunanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bangunan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nomor_bangunan' => rand(1,99),
            'pemilik_id' => rand(1,10),
            'kelurahan_id' => rand(2,3),
            'lingkungan' => rand(1,15),
            'alamat' => $this->faker->address()
        ];
    }
}
