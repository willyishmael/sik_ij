<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function login(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // var_dump($validated);

        // $emailCheck;
        // if ($validator['email'] == User::with()) {

        // }

        // if (Hash::check($validator['password'], $hashedValue))

        $users = User::where('email', '=', $request->input('email'))->first();
        // var_dump($users);
        if ($users === null) {
            dd($users);
        } else {
            // echo($users['password']);

            if (Hash::check($validated['password'], $users['password'])) {
                // echo('so jadi');
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            } else {
                // echo('blum jadi');
            };
        };
    }
}