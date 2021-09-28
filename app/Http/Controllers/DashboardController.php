<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function showCount(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
        ]);
        
        // $kelurahan_id = 2;

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];
        $penduduk = Penduduk::select('penduduks.*')
            ->join('bangunans', 'penduduks.bangunan_id', '=', 'bangunans.id')
            ->where('bangunans.kelurahan_id', $kelurahan_id)->get();
        $bangunan = Bangunan::where('kelurahan_id',$kelurahan_id)->get();

        $jumlahPenduduk = $penduduk->count();
        $jumlahBangunan = $bangunan->count();

        $pria = (integer)$penduduk->where('jenis_kelamin','Laki-laki')->count();
        $wanita = (integer)$penduduk->where('jenis_kelamin','Perempuan')->count();

        $presentasePr = ($pria/$jumlahPenduduk)*100;
        $presentaseWn = ($wanita/$jumlahPenduduk)*100;

        return response()->json([
            'message' => 'Success',
            'jumlah_penduduk' => $jumlahPenduduk,
            'jumlah_bangunan' => $jumlahBangunan,
            'jumlah_pria' => $pria,
            'jumlah_wanita' => $wanita,
            'presentase_pria' => round($presentasePr,0),
            'presentase_wanita' => round($presentaseWn,0)
        ], 200);
    }
}
