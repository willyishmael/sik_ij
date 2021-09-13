<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function store(Request $request) {

        $validated = $request->validate([
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

    }
    public function update() {}
    public function destroy() {}
    
}
