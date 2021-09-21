<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
  
            $user = User::where('email', $request['email'])->first();
            
            // $user->kelurahan;
            // $user->kelurahan->lurah;
            // $user->kelurahan->sekretaris;

            // $penduduk = Penduduk::where('kelurahan_id', $user->kelurahan_id)->get();
 
            return response()->json([
                'message' => 'Success',
                'user' => $user,
                // 'penduduk' => $penduduk
            ], 200);

        } else {
            return response()->json([
                'message' => 'Username dan Password Salah',
            ], 401);
        }

    }

    
}