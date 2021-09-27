<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\Kelurahan;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendudukController extends Controller
{
    public function show(Request $request) {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'kelurahan_id' => 'required'
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        $penduduk = Penduduk::select('penduduks.*')
            ->join('bangunans', 'penduduks.bangunan_id', '=', 'bangunans.id')
            ->where('bangunans.kelurahan_id', $kelurahan_id)->get();

        $bangunan = Bangunan::select('id')->where('kelurahan_id',$kelurahan_id)->get();

        return response()->json([
            'remember_token' => $request->remember_token,
            'kelurahan_id' => $kelurahan_id,
            'bangunan_id' => $bangunan,
            'penduduk' => $penduduk,
        ], 200);
    }

    public function create(Request $request) {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'nama' => 'required',
            'bangunan_id' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_kk' => 'required',
            'nik' => 'required'|'unique',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',   
        ]);

        $new_penduduk = Penduduk::create([
            'nama' => $request->nama,
            'bangunan_id' => $request->bangunan_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_kk' => $request->nomor_kk,
            'nik' => $request->nik,
            'nomor_telepon' => $request->nomor_telepon,
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
                'penduduk' => $saved,
            ], 200);
        }
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);

        $penduduk = Penduduk::where('id', $request->id)->first();

        $penduduk->nama = $request['nama'];
        $penduduk->bangunan_id = $request['bangunan_id'];
        $penduduk->tempat_lahir = $request['tempat_lahir'];
        $penduduk->tanggal_lahir = $request['tanggal_lahir'];
        $penduduk->nomor_kk = $request['nomor_kk'];
        $penduduk->nik = $request['nik'];
        $penduduk->nomor_telepon = $request['nomor_telepon'];
        $penduduk->email = $request['email'];
        $penduduk->jenis_kelamin = $request['jenis_kelamin'];
        $penduduk->status_pernikahan = $request['status_pernikahan'];

        $updated = $penduduk->save();

        if(!$updated){
            Penduduk::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Update success',
                'penduduk' => $updated
            ], 200);
        }
    }

    public function delete(Request $request)
    {

        Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);

        $penduduk = Penduduk::where('id',$request['id'])->first();

        $deleted = $penduduk->delete();

        if(!$deleted){
            Penduduk::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Delete success'
            ], 200);
        }
    }
}
