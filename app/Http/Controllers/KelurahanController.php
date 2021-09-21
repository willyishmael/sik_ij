<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelurahanController extends Controller
{
    public function show(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];
        $kelurahan = Kelurahan::where('id', $kelurahan_id)->first();

        $kelurahan->lurah;
        $kelurahan->sekretaris;

        return response()->json([
            'kelurahan' => $kelurahan
        ], 200);
    }


    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'alamat_kantor' => 'required',
            'telepon_kelurahan' => 'required',
            'email_kelurahan' => 'required',
            'nama_lurah' => 'required',
            'nip_lurah' => 'required',
            'email_lurah' => 'required',
            'nomor_telepon_lurah' => 'required',
            'nama_sekretaris' => 'required',
            'nip_sekretaris' => 'required',
            'email_sekretaris' => 'required',
            'nomor_telepon_sekretaris' => 'required',
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        $kelurahan = Kelurahan::where('id', $kelurahan_id)->first();

        $kelurahan->alamat_kantor = $request['alamat_kantor'];
        $kelurahan->telepon_kelurahan = $request['telepon_kelurahan'];
        $kelurahan->email_kelurahan = $request['email_kelurahan'];

        $kelurahan->lurah->nama = $request['nama_lurah'];
        $kelurahan->lurah->nip = $request['nip_lurah'];
        $kelurahan->lurah->email = $request['email_lurah'];
        $kelurahan->lurah->nomor_telepon = $request['nomor_telepon_lurah'];

        $kelurahan->sekretaris->nama = $request['nama_sekretaris'];
        $kelurahan->sekretaris->nip = $request['nip_sekretaris'];
        $kelurahan->sekretaris->email = $request['email_sekretaris'];
        $kelurahan->sekretaris->nomor_telepon = $request['nomor_telepon_sekretaris'];

        $kelurahan->save();

        return response()->json([
            'message' => 'Update success'
        ], 200);
    }

}
