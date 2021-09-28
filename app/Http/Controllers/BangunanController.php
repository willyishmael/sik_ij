<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\Object_;

class BangunanController extends Controller
{
    public function store()
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
            // $object['timestamp'] = now();
            Bangunan::insert($object);
        }

        return response($data);
    }
}
