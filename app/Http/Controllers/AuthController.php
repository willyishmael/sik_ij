<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function checkUserToken(Request $request) {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'page' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'fails to validate'
            ], 400);
        }

        $user = User::where('remember_token', '=', $request['token'])
                ->first();

        if ($request->page == 'penduduk' && $user->role != 'admin') {

            return response()->json([
                'auth' => 'true',
                'redirect_to' => 'dashboard',
                'message' => 'this page is restricted to this user'
            ], 401);

        } else {
            $menus = [
                [
                    'title' => 'Beranda',
                    'icon' => 'mdi-home',
                    'link' => 'dashboard'
                ],
                [
                    'title' => 'Profil Kelurahan',
                    'icon' => 'fa-institution',
                    'link' => 'tables'
                ],
                [
                    'title' => 'Peta Kelurahan',
                    'icon' => 'mdi-tooltip-image',
                    'link' => 'petkel'
                ],
            ];
            
            if ($user->role == 'admin') {
                $admin_menus = $menus;
                array_push($admin_menus, [
                    'title' => 'Penduduk',
                    'icon' => 'mdi-account-multiple',
                    'link' => 'typography'
                ]);

                return response()->json([
                    'auth' => 'true',
                    'redirect_to' => $request->page,
                    'message' => 'User is Admin',
                    'admin_menus' => $admin_menus
                ]);

            } elseif ($user->role == 'operator') {
                $operator_menus = $menus;

                return response()->json([
                    'auth' => 'true',
                    'redirect_to' => $request->page,
                    'message' => 'User is Operator',
                    'operator_menus' => $operator_menus
                ]);

            } else {
                return response()->json([
                    'auth' => 'false',
                    'redirect_to' => 'login',
                    'message' => 'user not authenticated, please re-login'
                ], 401);
            }

            
        }
    }
}
