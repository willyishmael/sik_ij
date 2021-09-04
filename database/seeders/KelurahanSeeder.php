<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelurahan::create([
            'nama_kelurahan' => 'Karombasan',
            'lurah_id' => 3,
            'sekretaris_id' => 7
        ]);

        Kelurahan::create([
            'nama_kelurahan' => 'Bahu',
            'lurah_id' => 1,
            'sekretaris_id' => 2
        ]);
    }
}
