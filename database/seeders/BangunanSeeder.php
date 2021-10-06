<?php

namespace Database\Seeders;

use App\Models\Bangunan;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BangunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $data = Http::get('http://geoportal.manadokota.go.id/geoserver/wfs?srsName=EPSG%3A4326&typename=geonode%3Akelurahan_karame_kecsingkil_1&outputFormat=json&version=1.0.0&service=WFS&request=GetFeature&access_token=oSi0KWhuVqDEv3Ati0nJeTAZBBmM2E')['features'];
      
        for ($i=0; $i < count($data); $i++) { 
            $item = $data[$i]['properties'];
            $object = [];
            $object['nomor_bangunan'] = $item['no_bng'];
            $object['nama_pemilik'] = $faker->name();
            $object['nik_pemilik'] = "717107".(string)rand(1000000000,9999999999);
            $object['kelurahan_id'] = 4;
            $object['lingkungan'] = $item['lingkungan'];
            $object['alamat'] = $faker->address();
            $object['created_at'] = now();
            $object['updated_at'] = now();
            Bangunan::insert($object);
        }

        //----------------------------------------------

        // $faker = Factory::create();
        // $path = 'D:\Productivity\Programming\application\sik-ij\savefile\karame_center_coordinates.json';
        // $content = json_decode(file_get_contents($path), true);
        // $data = $content['features'];

        // for ($i=0; $i < count($data); $i++) {
        //     $item = $data[$i]['attributes'];
        //     $coordinate = $data[$i]['geometry'];
        //     $coorX = $coordinate['x'];
        //     $coorY = $coordinate['y'];

        //     $object = [];
        //     $object['nomor_bangunan'] = $item['no_bng'];
        //     $object['nama_pemilik'] = $faker->name();
        //     $object['nik_pemilik'] = "717107".(string)rand(1000000000,9999999999);
        //     $object['kelurahan_id'] = 4;
        //     $object['lingkungan'] = "Tidak Ada Lingkungan";
        //     $object['alamat'] = $faker->address();
        //     // $object['koordinat'] = DB::raw("(GeomFromText('POINT($coorX $coorY)'))");
        //     $object['created_at'] = now();
        //     $object['updated_at'] = now();
        //     Bangunan::insert($object);
        // }

        Bangunan::factory()
                ->count(50)
                ->create();
    }
}
