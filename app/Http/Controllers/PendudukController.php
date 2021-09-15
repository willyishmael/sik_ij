<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function jumlahPendudukKelurahan() {
        $jpk = Penduduk::all();
        return response()->json($jpk, 200);
    }

    public function jumlahKelurahan() {
        $jk = Kelurahan::all();
        return response()->json($jk, 200);
    }
    
    public function jumlahPendudukTotal(Request $request)
    {
        $penduduk = Penduduk::where('id', '*')->get();
        $jumlah = $penduduk->count();

        return response()->json([
            'message' => 'Success',
            'jumlah_penduduk' => $jumlah,
        ], 200);
    }

    
}