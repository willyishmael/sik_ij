<?php

namespace Database\Seeders;

use App\Models\PerangkatKelurahan;
use Illuminate\Database\Seeder;

class PerangkatKelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PerangkatKelurahan::factory()
            ->count(10)
            ->create();
    }
}
