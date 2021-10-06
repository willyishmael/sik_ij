<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\Kelurahan;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BangunanController extends Controller
{
    private function bangunan_id(string $remember_token, int $bangunan_id)
    {
        $kelurahan_id = User::where('remember_token', $remember_token)->first()['kelurahan_id'];
        $kelurahan = Kelurahan::where('id', $kelurahan_id)->first()['kelurahan'];
        $prefix = 'kelurahan_'.$kelurahan.'_kecsingkil_1.';
        $new_bangunan_id = $prefix.$bangunan_id;

        return $new_bangunan_id;
    }

    private function bangunanPenghuni(string $bangunan_id)
    {
        $bangunan = Bangunan::where('id', $bangunan_id)->first();
        $penghuni = Penduduk::where('bangunan_id', $bangunan_id)->get();
        return response()->json([
            'bangunan' => $bangunan,
            'penghuni' => $penghuni
        ], 200);
    }

    public function show(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'bangunan_id' => 'required'
        ], [
            'required' => 'The attribute field is required.'
        ]);

        // $request->bangunan_id = 3;

        $bangunan_id = $this->bangunan_id($request->remember_token, $request->bangunan_id);

        $this->bangunanPenghuni($bangunan_id);
    }

    public function search(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'nik' => 'required'
        ], [
            'required' => 'The attribute field is required.'
        ]);

        $bangunan_id = Penduduk::where('nik', $request->nik)->first['bangunan_id'];

        $this->bangunanPenghuni($bangunan_id);
    }
}
