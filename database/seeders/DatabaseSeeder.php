<?php

namespace Database\Seeders;

//use App\Models\...;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->call([
            RoleSeeder::class,
            PerangkatKelurahanSeeder::class,
            KelurahanSeeder::class,
            PemilikSeeder::class,
            RumahSeeder::class,
            PendudukSeeder::class,
            UserSeeder::class
        ]);
    }
}
