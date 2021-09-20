<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function show() {
        $jpk = Penduduk::all();
        return response()->json($jpk, 200);

        return response()->json([
            'message' => 'Menampilkan data penduduk',
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
            'kelurahan_id' => $request->kelurahan_id,
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

    public function update(Request $request)
    {
        $penduduk = Penduduk::where('id', $request['id'])->first();

        $penduduk->penduduk = $request['nama'];
        $penduduk->penduduk = $request['rumah_id'];
        $penduduk->penduduk = $request['kelurahan_id'];
        $penduduk->penduduk = $request['tempat_lahir'];
        $penduduk->penduduk = $request['tanggal_lahir'];
        $penduduk->penduduk = $request['no_kk'];
        $penduduk->penduduk = $request['nik'];
        $penduduk->penduduk = $request['no_telp'];
        $penduduk->penduduk = $request['email'];
        $penduduk->penduduk = $request['jenis_kelamin'];
        $penduduk->penduduk = $request['status_pernikahan'];

        $updated = $penduduk->save();

        if(!$updated){
            Penduduk::abort(500, 'Error');
        } else {
            return response()->json([
                'message' => 'Update success'
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
