<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    public function index()
    {
        return view('login.index', [
            'title' => 'SIK Login'
        ]);
    }

     public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // return redirect()->intended('/dashboard');
            return response()->json([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ], 200);
        } else {
            return response()->json([
                'message' => 'salah no nn pokoknya'
            ], 401);
        }

        // return back()->with('loginError', 'Login failed!');
    }

    
}