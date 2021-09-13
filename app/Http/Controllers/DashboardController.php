<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function jumlahPendudukKelurahan()
    {
        $jpk = (array) Penduduk::all();
        return response()->json($jpk, 200);
    }
    
    public function jumlahPenduduk(Request $request)
    {
        $penduduk = Penduduk::where('id', '*')->get();
        $jumlah = $penduduk->count();

        return response()->json([
            'message' => 'Success',
            'jumlah_penduduk' => $jumlah,
        ], 200);
    }

    
}
