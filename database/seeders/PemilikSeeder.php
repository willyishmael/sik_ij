<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use App\Models\Rumah;
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
        ->has(Rumah::factory()->count(3))
        ->create();
    }
}
