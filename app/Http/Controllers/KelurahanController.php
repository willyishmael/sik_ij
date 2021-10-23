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
            'nama_lurah' => 'required'

        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan = $this->getKelurahan($request->remember_token);

        $searchId = PerangkatKelurahan::where('nama',$request->nama_lurah)->first()['id'];

        //change lurah assigned status
        $currentLurah = PerangkatKelurahan::where('id',$kelurahan->lurah_id)->first();
        $currentLurah->assigned = 0;
        $newLurah = PerangkatKelurahan::where('id',$searchId)->first();
        $newLurah->assigned = 1;

        //change lurah
        $kelurahan->lurah_id = $searchId;
        $saved = $kelurahan->save();

        if(!$saved){
            PerangkatKelurahan::abort(500, 'Error');
        } else {
            $currentLurah->save();
            $newLurah->save();
            return response()->json([
                'message' => 'Update Lurah Success',
                'lurah' => $newLurah,
            ], 200);
        }
    }

    public function updateSekretaris(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'nama_sekretaris' => 'required',
        ], [
            'required' => 'The attribute field is required.'
        ]);

        $kelurahan = $this->getKelurahan($request->remember_token);

        $searchId = PerangkatKelurahan::where('nama',$request->nama_sekretaris)->first()['id'];

        $currentSekretaris = PerangkatKelurahan::where('id',$kelurahan->sekretaris_id)->first();
        $currentSekretaris->assigned = 0;
        $newSekretaris = PerangkatKelurahan::where('id',$searchId)->first();
        $newSekretaris->assigned = 1;

        $kelurahan->sekretaris_id = $searchId;
        $saved = $kelurahan->save();

        if(!$saved){
            PerangkatKelurahan::abort(500, 'Error');
        } else {
            $currentSekretaris->save();
            $newSekretaris->save();
            return response()->json([
                'message' => 'Update Sekretaris Success',
                'sekretaris' => $newSekretaris,
            ], 200);
        }
    }
}