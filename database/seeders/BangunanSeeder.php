<?php

namespace Database\Seeders;

use App\Models\Bangunan;
use Illuminate\Database\Seeder;

class BangunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$pemilik = Pemilik::factory()->create();
        Bangunan::factory()
                ->count(10)
                ->create();
    }
}
