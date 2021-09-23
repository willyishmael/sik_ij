<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendudukController extends Controller
{
    public function show(Request $request) {
        Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        $penduduk = Penduduk::select('penduduks.*')
            ->join('bangunans', 'penduduks.bangunan_id', '=', 'bangunans.id')
            ->where('bangunans.kelurahan_id', $kelurahan_id)->get();

        return response()->json([
            'remember_token' => $request->remember_token,
            'kelurahan_id' => $kelurahan_id,
            'penduduk' => $penduduk,
        ], 200);
    }
    
    public function showCount()
    {
        $penduduk = Penduduk::where('id', '*')->get();
        $jumlah = $penduduk->count();

        return response()->json([
            'message' => 'Success',
            'jumlah_penduduk' => $jumlah,
        ], 200);
    }

    public function create(Request $request) {

        $request->validate([
            'nama' => 'required',
            'rumah_id' => 'required',
            'kelurahan_id' => 'required',
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
            'rumah_id' => $request->rumah_id,
            'kelurahan_id' => $request->kelurahan_id,
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
        $penduduk = Penduduk::where('id', $request['id'])->first();

        $penduduk->penduduk = $request['nama'];
        $penduduk->penduduk = $request['rumah_id'];
        $penduduk->penduduk = $request['kelurahan_id'];
        $penduduk->penduduk = $request['tempat_lahir'];
        $penduduk->penduduk = $request['tanggal_lahir'];
        $penduduk->penduduk = $request['nomor_kk'];
        $penduduk->penduduk = $request['nik'];
        $penduduk->penduduk = $request['nomor_telepon'];
        $penduduk->penduduk = $request['email'];
        $penduduk->penduduk = $request['jenis_kelamin'];
        $penduduk->penduduk = $request['status_pernikahan'];

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
