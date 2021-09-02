<?php

namespace Database\Seeders;

use app\Models\Kelurahan;
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
        Kelurahan::create([[
            'nama_kelurahan' => 'karombasan',
            'lurah_id' => '3',
            'sekretaris_id' => '7'
        ],[
            'nama_kelurahan' => 'Bahu',
            'lurah_id' => '1',
            'sekretaris_id' => '2'
        ]]);
    }
}
