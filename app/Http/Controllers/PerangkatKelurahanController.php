<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\PerangkatKelurahan;
use Illuminate\Http\Request;

class PerangkatKelurahanController extends Controller
{
    public function show()
    {
        $perangkat = PerangkatKelurahan::all();
        
        // $namaArray = [];

        // for ($i=0; $i < count($perangkat); $i++) { 
        //     array_push($namaArray, $perangkat[$i]['nama']);
        // }

        return response()->json([
            'perangkat' => $perangkat
        ], 200);
    }

    public function unassignedPerangkat()
    {
        $perangkat = PerangkatKelurahan::select('*')
            ->where('assigned','false')
            ->get();
        
        return response()->json($perangkat,200);
    }
}
