<?php

namespace Database\Factories;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendudukFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penduduk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status_pernikahan = ['Belum Menikah','Sudah Menikah','Janda/Duda'];
        $jenis_kelamin = ['Laki-laki','Perempuan'];
        
        return [
            'nama' => $this->faker->name(),
            'rumah_id' => rand(1,10),
            'kelurahan_id' => rand(2,3),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'no_kk' => "717107".(string)rand(1000000000,9999999999),
            'nik' => "717107".(string)rand(1000000000,9999999999),
            'no_telp' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'jenis_kelamin' => $jenis_kelamin[rand(0,1)],
            'status_pernikahan' => $status_pernikahan[rand(0,2)],
        ];
    }
}
