<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\PerangkatKelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelurahanController extends Controller
{
    private function getKelurahan($remember_token)
    {
        $kelurahan_id = User::where('remember_token', $remember_token)->first()['kelurahan_id'];
        $kelurahan = Kelurahan::where('id', $kelurahan_id)->first();

        return $kelurahan;
    }

    public function show(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);
       
        $kelurahan = $this->getKelurahan($request->remember_token);

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

        $profil = $this->getKelurahan($request->remember_token);

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
            'remember_token' => 'required',
            'nama_lurah' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required'

        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan = $this->getKelurahan($request->remember_token);

        $getLurah = $kelurahan->lurah_id;
        $lurah = PerangkatKelurahan::where('id',$getLurah)->first();

        $lurah->nama = $request['nama_lurah'];
        $lurah->nip = $request['nip'];
        $lurah->email = $request['email'];
        $lurah->nomor_telepon = $request['nomor_telepon'];

        $saved = $lurah->save();

        if(!$saved){
            PerangkatKelurahan::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Update Lurah Success',
            ], 200);
        }
    }

    public function updateSekretaris(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'nama_sekretaris' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required'

        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan = $this->getKelurahan($request->remember_token);

        $getSekretaris = $kelurahan->sekretaris_id;
        $sekretaris = PerangkatKelurahan::where('id',$getSekretaris)->first();

        $sekretaris->nama = $request['nama_sekretaris'];
        $sekretaris->nip = $request['nip'];
        $sekretaris->email = $request['email'];
        $sekretaris->nomor_telepon = $request['nomor_telepon'];

        $saved = $sekretaris->save();

        if(!$saved){
            PerangkatKelurahan::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Update Sekretaris Success',
            ], 200);
        }
    }

}
