<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request) {
        return response()->json([
            'message' => 'logout berhasil'
        ], 200);
    }

}
