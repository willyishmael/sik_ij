<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Faker\Factory;
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
        $faker = Factory::create();

        Kelurahan::create([
            'kelurahan' => 'Admin',
            'kecamatan' => 'Admin',
            'kabupaten_kota' => 'Manado',
            'provinsi' => 'Sulawesi Utara',
            'alamat_kantor' => $faker->address(),
            'telepon_kelurahan' => $faker->phoneNumber(),
            'email_kelurahan' => $faker->safeEmail(),
            'lurah_id' => 1,
            'sekretaris_id' => 2
        ]);

        Kelurahan::create([
            'kelurahan' => 'Karombasan',
            'kecamatan' => 'Wanea',
            'kabupaten_kota' => 'Manado',
            'provinsi' => 'Sulawesi Utara',
            'alamat_kantor' => $faker->address(),
            'telepon_kelurahan' => $faker->phoneNumber(),
            'email_kelurahan' => $faker->safeEmail(),
            'lurah_id' => 3,
            'sekretaris_id' => 4
        ]);

        Kelurahan::create([
            'kelurahan' => 'Bahu',
            'kecamatan' => 'Malalayang',
            'kabupaten_kota' => 'Manado',
            'provinsi' => 'Sulawesi Utara',
            'alamat_kantor' => $faker->address(),
            'telepon_kelurahan' => $faker->phoneNumber(),
            'email_kelurahan' => $faker->safeEmail(),
            'lurah_id' => 5,
            'sekretaris_id' => 6
        ]);

        Kelurahan::create([
            'kelurahan' => 'Karame',
            'kecamatan' => 'Singkil',
            'kabupaten_kota' => 'Manado',
            'provinsi' => 'Sulawesi Utara',
            'alamat_kantor' => $faker->address(),
            'telepon_kelurahan' => $faker->phoneNumber(),
            'email_kelurahan' => $faker->safeEmail(),
            'lurah_id' => 7,
            'sekretaris_id' => 8
        ]);
    }
}
