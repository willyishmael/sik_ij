<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    public function showDataKelurahan(Request $request)
    {
        // $kelurahan_id = User::select('kelurahan_id')
        //         ->where('remember_token', '=', $request->token)
        //         ->first();

        // $kelurahan_id = Auth::user()->kelurahan_id;

        if (true) {
        
            // $kelurahan_id = User::select('remember_token')
            //     ->where('email','=',$request['email'])
            //     ->first();

            $kelurahan_id = 1;

            $kelurahan = Kelurahan::select('kelurahans.*')
                ->where('kelurahans.id', '=', $kelurahan_id)
                ->first();

            $lurah = Kelurahan::join('penduduks', 'kelurahans.lurah_id', '=', 'penduduks.id')
                ->select('penduduks.nama as nama_lurah', 'penduduks.no_telp as no_telp_lurah' ,'penduduks.email as email_lurah')
                ->where('kelurahans.id', '=',  $kelurahan_id)
                ->first();

            $sekretaris = Kelurahan::join('penduduks', 'kelurahans.sekretaris_id', '=', 'penduduks.id')
                ->select('penduduks.nama as nama_sekretaris', 'penduduks.no_telp as no_telp_sekretaris', 'penduduks.email as email_sekretaris')
                ->where('kelurahans.id', '=',  $kelurahan_id)
                ->first();

            //$obj_merged = array_merge_recursive((array) $kelurahan, (array) $lurah, (array) $sekretaris);

            return response()->json([
                'kelurahan_id' => $kelurahan_id,
                'kelurahan' => $kelurahan,
                'lurah' => $lurah,
                'sekretaris' => $sekretaris,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Token salah, redirect ke login',
                'token' => $request->token
            ], 401);
        }
    }
}
