<?php

namespace Database\Seeders;

use App\Models\Rumah;
use Illuminate\Database\Seeder;

class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$pemilik = Pemilik::factory()->create();
        Rumah::factory()
                ->count(10)
                ->create();
    }
}
