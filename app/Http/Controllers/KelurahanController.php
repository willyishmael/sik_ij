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


    public function updateProfil(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'alamat_kantor' => 'required|email',
            'telepon_kelurahan' => 'required',
            'email_kelurahan' => 'required',
        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        $profil = Kelurahan::where('id', $kelurahan_id)->first();

        $profil->alamat_kantor = $request['alamat_kantor'];
        $profil->telepon_kelurahan = $request['telepon_kelurahan'];
        $profil->email_kelurahan = $request['email_kelurahan'];

        $profil->save();

        return response()->json([
            'message' => 'Update Profil Kelurahan Success'
        ], 200);
    }

    public function updateLurah(Request $request)
    {
        Validator::make($request->all(), [
            'nama_lurah' => 'required',
            'nip_lurah' => 'required',
            'email_lurah' => 'required',
            'nomor_telepon_lurah' => 'required',
        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        $lurah = Kelurahan::where('id', $kelurahan_id)->first();

        $lurah->lurah->nama = $request['nama_lurah'];
        $lurah->lurah->nip = $request['nip_lurah'];
        $lurah->lurah->email = $request['email_lurah'];
        $lurah->lurah->nomor_telepon = $request['nomor_telepon_lurah'];

        $lurah->save();

        return response()->json([
            'message' => 'Update Lurah Success'
        ], 200);
    }

    public function updateSekretaris(Request $request)
    {
        Validator::make($request->all(), [
            'nama_sekretaris' => 'required',
            'nip_sekretaris' => 'required',
            'email_sekretaris' => 'required',
            'nomor_telepon_sekretaris' => 'required',
        ], [
            'required' => 'The attribute field is required.'
        ]);

            $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];
            
            $sekretaris = Kelurahan::where('id', $kelurahan_id)->first();
            
            $sekretaris->sekretaris->nama = $request['nama_sekretaris'];
            $sekretaris->sekretaris->nip = $request['nip_sekretaris'];
            $sekretaris->sekretaris->email = $request['email_sekretaris'];
            $sekretaris->sekretaris->nomor_telepon = $request['nomor_telepon_sekretaris'];

            $sekretaris->save();
            
            return response()->json([
                'message' => 'Update Sekretaris Success'
            ], 200);
    }

}
