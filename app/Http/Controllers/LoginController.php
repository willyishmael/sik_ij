<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    public function index()
    {
        return response()->json([
            'msg' => ''

        ], 200);
    }

     public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // $user = User::where('email', $credentials['email']->first());

        // dd(User::where('email', $credentials['email']->first()));
        //     $request->session()->regenerate();

            // return redirect()->intended('/dashboard');
            // return response()->json($user->toJson(), 200);

            return response()->json([
                'message' => 'Success',
            ], 200);

        } else {
            return response()->json([
                'message' => 'Username dan Password Salah'
            ], 401);
        }

        // return back()->with('loginError', 'Login failed!');
    }

    
}