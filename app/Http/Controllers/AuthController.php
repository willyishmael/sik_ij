<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AuthController
{
    public function checkUserToken($email, $userToken) {
        $rememberToken = DB::table('users')
            ->select('remember_token')
            ->where('email','=', $email)
            ->first();

        if ($userToken === $rememberToken) {
            return true;
        } else {
            return false;
        }
    }
}
