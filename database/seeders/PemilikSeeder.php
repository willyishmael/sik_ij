<?php

namespace Database\Seeders;

use App\Models\Bangunan;
use App\Models\Pemilik;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemilik::factory()
        ->count(10)
        ->has(Bangunan::factory()->count(3))
        ->create();
    }
}
