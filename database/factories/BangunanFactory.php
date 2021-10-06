<?php

namespace Database\Factories;

use App\Models\Bangunan;
use App\Models\Pemilik;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
        // $rand = rand(1,99);
        // $rand2 = rand(1,99);

        return [
            'nomor_bangunan' => rand(1,99),
            'nama_pemilik' => $this->faker->name(),
            'nik_pemilik' => "717107".(string)rand(1000000000,9999999999),
            'kelurahan_id' => rand(2,3),
            'lingkungan' => "00".(string)rand(1,9),
            'alamat' => $this->faker->address(),
            // 'koordinat' => DB::raw("(GeomFromText('POINT($rand $rand2)'))"),
        ];
    }
}
