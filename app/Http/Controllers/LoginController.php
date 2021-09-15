<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

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
  
            $kelurahan = DB::table('users')
                ->select('id','name','email','kelurahan_id','role')
                ->where('email','=', $request['email'])
                ->get();

            $allKelurahan = DB::table('users')
                ->select('*')
                ->first();

            return response()->json(
                
                array_merge_recursive([
                    'message' => 'Success',
                    'token' => $allKelurahan->remember_token,
                ],(array) $kelurahan), 200);

        } else {
            return response()->json([
                'message' => 'Username dan Password Salah',
            ], 401);
        }

    }

    
}