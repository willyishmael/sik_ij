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
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'kelurahan_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'operator',
            'email' => 'operator@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('operator'),
            'role' => 'operator',
            'kelurahan_id' => '2',
            'remember_token' => Str::random(10)
        ]);
    }
}
