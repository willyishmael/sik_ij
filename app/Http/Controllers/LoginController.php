<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function test()
    {
        $kelurahan = Kelurahan::find(1);
        $kelurahan->lurah;
        $kelurahan->sekretaris;

        return response()->json($kelurahan);
        
    }

    public function index()
    {
        return view('login.index');
    }

     public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
  
            $user = User::where('email','=', $request['email'])->first();

            // $kelurahan_id = $user->kelurahan_id;

            // $kelurahan = Kelurahan::select('kelurahans.*')
            //     ->where('kelurahans.id', '=', $kelurahan_id)
            //     ->first();
            
            $user->kelurahan;
            $user->kelurahan->lurah;
            $user->kelurahan->sekretaris;


            // $lurah = Kelurahan::join('penduduks', 'kelurahans.lurah_id', '=', 'penduduks.id')
            //     ->select('penduduks.nama as nama_lurah', 'penduduks.no_telp as no_telp_lurah' ,'penduduks.email as email_lurah')
            //     ->where('kelurahans.id', '=',  $kelurahan_id)
            //     ->first();

            // $sekretaris = Kelurahan::join('penduduks', 'kelurahans.sekretaris_id', '=', 'penduduks.id')
            //     ->select('penduduks.nama as nama_sekretaris', 'penduduks.no_telp as no_telp_sekretaris', 'penduduks.email as email_sekretaris')
            //     ->where('kelurahans.id', '=',  $kelurahan_id)
            //     ->first();

            return response()->json([
                'message' => 'Success',
                'user' => $user,
                // 'kelurahan' => $kelurahan,
                // 'lurah' => $lurah,
                // 'sekretaris' => $sekretaris,
            ], 200);

        } else {
            return response()->json([
                'message' => 'Username dan Password Salah',
            ], 401);
        }

    }

    
}