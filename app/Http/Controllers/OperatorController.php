<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Pemilik;
use App\Models\Penduduk;
use App\Models\Rumah;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function storePenduduk(Request $request) {

        $request->validate([
            'nama' => 'required',
            'rumah_id' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_kk' => 'required'|'unique',
            'nik' => 'required'|'unique',
            'no_telp' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',   
        ]);

        $new_penduduk = Penduduk::create([
            'nama' => $request->nama,
            'rumah_id' => $request->rumah_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        $saved = $new_penduduk->save();

        if(!$saved){
            Penduduk::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Success Menambahkan Data',
            ], 200);
        }
    }

    public function storeKelurahan(Request $request) {

        $request->validate([
            'nama_kelurahan' => 'required',
            'lurah_id' => 'required',
            'sekretaris_id' => 'required',
        ]);

        $new_kelurahan = Kelurahan::create([
            'nama_kelurahan' => $request->nama_kelurahan,
            'lurah_id' => $request->lurah_id,
            'sekretaris_id' => $request->sekretaris_id,
        ]);

        $saved = $new_kelurahan->save();

        if(!$saved){
            Kelurahan::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Success Menambahkan Data',
            ], 200);
        }
    }

    public function storeRumah(Request $request) {

        $request->validate([
            'no_rumah' => 'required',
            'pemilik_id' => 'required',
            'lingkungan' => 'required',
            'alamat' => 'required',
        ]);

        $new_rumah = Rumah::create([
            'no_rumah' => $request->no_rumah,
            'pemilik_id' => $request->pemilik_id,
            'lingkungan' => $request->lingkungan,
            'alamat' => $request->alamat,
        ]);

        $saved = $new_rumah->save();

        if(!$saved){
            Rumah::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Success Menambahkan Data',
            ], 200);
        }
    }

    public function storePemilik(Request $request) {

        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
        ]);

        $new_pemilik = Pemilik::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
        ]);

        $saved = $new_pemilik->save();
        
        if(!$saved){
            Pemilik::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Success Menambahkan Data',
            ], 200);
        }

    }

    public function update() {

    }

    public function destroy() {

    }

    
    
}
