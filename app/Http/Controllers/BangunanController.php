<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\Kelurahan;
use App\Models\Penduduk;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
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
            Bangunan::insert($object);
        }

        return response($data);
    }

    public function show(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        // $kelurahan_id = 4;

        $bangunan = Bangunan::select('nomor_bangunan','nama_pemilik','nik_pemilik')->where('kelurahan_id',$kelurahan_id)->get();

        $penduduk = Penduduk::select('penduduks.*')
            ->join('bangunans', 'penduduks.bangunan_id', '=', 'bangunans.id')
            ->where('bangunans.kelurahan_id', $kelurahan_id)->get();

        return response()->json([
            'kelurahan_id' => $kelurahan_id,
            'bangunan' => $bangunan,
            'penduduk' => $penduduk
        ], 200);
    }
}
