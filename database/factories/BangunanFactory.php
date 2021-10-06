<?php

namespace Database\Factories;

use App\Models\Bangunan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BangunanFactory extends Factory
{
    protected $model = Bangunan::class;

    public function definition()
    {
        return [
            'id' => Str::random(10),
            'nomor_bangunan' => rand(1000,9999),
            'nama_pemilik' => $this->faker->name(),
            'nik_pemilik' => "717107".(string)rand(1000000000,9999999999),
            'kelurahan_id' => rand(2,3),
            'lingkungan' => "00".(string)rand(1,9),
            'alamat' => $this->faker->address(),
            // 'koordinat' => DB::raw("(GeomFromText('POINT($rand $rand2)'))"),
        ];
    }
}
