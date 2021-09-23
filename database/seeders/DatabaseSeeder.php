<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {        
        $this->call([
            RoleSeeder::class,
            PerangkatKelurahanSeeder::class,
            KelurahanSeeder::class,
            BangunanSeeder::class,
            PendudukSeeder::class,
            UserSeeder::class
        ]);
    }
}
