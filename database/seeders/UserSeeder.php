<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
<<<<<<< HEAD
            'password' => bcrypt('admin'),
=======
            'password' => bcrypt('suntung123'),
>>>>>>> ee86940ec08fb673ea4dfd66123705d4975f3015
            'role_id' => '1',
            'kelurahan_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superadmin'),
            'role_id' => '2',
            'kelurahan_id' => '2',
            'remember_token' => Str::random(10)
        ]);
    }
}
