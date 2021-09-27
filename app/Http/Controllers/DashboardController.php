<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showCount()
    {
        $penduduk = Penduduk::all();
        $jumlah = $penduduk->count();

        return response()->json([
            'message' => 'Success',
            'jumlah_penduduk' => $jumlah,
        ], 200);
    }
}
