<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    public function showDataKelurahan(Request $request)
    {
        $kelurahan_id = Auth::user()->kelurahan_id;

        $kelurahan = DB::table('kelurahans')
            ->select('kelurahans.*')
            ->where('kelurahans.id', '=', $kelurahan_id)
            ->first();

        $lurah = DB::table('kelurahans')
            ->join('penduduks', 'kelurahans.lurah_id', '=', 'penduduks.id')
            ->select('penduduks.nama as nama_lurah', 'penduduks.no_telp as no_telp_lurah' ,'penduduks.email as email_lurah')
            ->where('kelurahans.id', '=',  $kelurahan_id)
            ->first();

        $sekretaris = DB::table('kelurahans')
            ->join('penduduks', 'kelurahans.sekretaris_id', '=', 'penduduks.id')
            ->select('penduduks.nama as nama_sekretaris', 'penduduks.no_telp as no_telp_sekretaris', 'penduduks.email as email_sekretaris')
            ->where('kelurahans.id', '=',  $kelurahan_id)
            ->first();

        $obj_merged = (object) array_merge_recursive((array) $kelurahan, (array) $lurah, (array) $sekretaris);

        return response()->json($obj_merged, 200);
    }
}
