<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    public function showDataKelurahan(Request $request)
    {
        $AuthController = new AuthController();
        $userAuth = $AuthController->checkUserToken($request['email'] , $request['token']);

        if ($userAuth) {
        
            $kelurahan_id = DB::table('users')
                ->select('remember_token')
                ->where('email','=',$request['email'])
                ->first();

            // $kelurahan_id = 1;

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

            $obj_merged = array_merge_recursive((array) $kelurahan, (array) $lurah, (array) $sekretaris);

            return response()->json($obj_merged, 200);
        } else {
            return response()->json([
                'msg' => 'Token salah, redirect ke login'
            ], 401);
        }
    }
}
