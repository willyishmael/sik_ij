<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function store(Request $request)
    {
        //
    }


    public function update(Request $request)
    {
        $kelurahan = Kelurahan::where('id', $request['id'])->first();

        $kelurahan->kelurahan = $request['kelurahan'];
        $kelurahan->kecamatan = $request['kecamatan'];
        $kelurahan->kabupaten_kota = $request['kabupaten_kota'];
        $kelurahan->provinsi = $request['provinsi'];
        $kelurahan->alamat_kantor = $request['alamat_kantor'];
        $kelurahan->telepon_kelurahan = $request['telepon_kelurahan'];
        $kelurahan->email_kelurahan = $request['email_kelurahan'];
        $kelurahan->lurah_id = $request['lurah_id'];
        $kelurahan->sekretaris_id = $request['sekretaris_id'];

        $kelurahan->save();

        return response()->json([
            'message' => 'Update success'
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
}
