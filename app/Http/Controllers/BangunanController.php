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
    private function getBangunanId(string $remember_token, int $bangunan_id)
    {
        $kelurahan_id = User::where('remember_token', $remember_token)->first()['kelurahan_id'];
        $kelurahan = Kelurahan::where('id', $kelurahan_id)->first()['kelurahan'];
        $kecamatan = Kelurahan::where('id', $kelurahan_id)->first()['kecamatan'];
        $prefix = 'kelurahan_'.$kelurahan.'_kec'.$kecamatan.'_1.';
        $new_bangunan_id = $prefix.$bangunan_id;

        return $new_bangunan_id;
    }

    private function getBangunanPenghuni(string $bangunan_id)
    {
        $bangunan = Bangunan::where('id', $bangunan_id)->first();
        $penghuni = Penduduk::where('bangunan_id', $bangunan_id)->get();
        $jumlah_penghuni = count($penghuni);

        return response()->json([
            'bangunan' => $bangunan,
            'jumlah_penghuni' => $jumlah_penghuni,
            'penghuni' => $penghuni
        ], 200);
    }

    private function deletePrefix(int $kelurahan_id, string $bangunan_id)
    {
        $kelurahan = strtolower(Kelurahan::where('id', $kelurahan_id)->first()['kelurahan']);
        $kecamatan = strtolower(Kelurahan::where('id', $kelurahan_id)->first()['kecamatan']);

        $new_bangunan_id = str_replace('kelurahan_'.$kelurahan.'_kec'.$kecamatan.'_1.','',$bangunan_id);

        return $new_bangunan_id;
    }

    public function map(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
        ], [
            'required' => 'The attribute field is required.'
        ]);

        if (!User::where('remember_token', $request->remember_token)->first()){
            return response()->json([
                'massage' => 'User not found'
            ], 401);
        }

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];
        // $kelurahan_id = 4;

        $bangunan = Bangunan::where('kelurahan_id', $kelurahan_id)->get();

        $daftar_bangunan = [];

        for ($i=0; $i < count($bangunan); $i++) { 
            $bangunan_item =[];

            $bangunan_id = $bangunan[$i]['id'];
            $penghuni = Penduduk::where('bangunan_id', $bangunan_id)->get();

            $bangunan[$i]['id'] = $this->deletePrefix($kelurahan_id, $bangunan[$i]['id']);
            $bangunan_item['bangunan'] = $bangunan[$i];
            $bangunan_item['jumlah_penghuni'] = count($penghuni);
            $bangunan_item['penghuni'] = $penghuni;

            $daftar_bangunan[] = $bangunan_item;
        }

        return response()->json([
            'daftar_bangunan' => $daftar_bangunan
        ], 200);
    }

    public function search(Request $request)
    {
        Validator::make($request->all(), [
            'remember_token' => 'required',
            'bangunan_id' => 'required'
        ], [
            'required' => 'The attribute field is required.'
        ]);

        if (!User::where('remember_token', $request->remember_token)->first()){
            return response()->json([
                'massage' => 'User not found'
            ], 401);
        }

        $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        // $kelurahan_id =4;
        // $request->bangunan_id = 'kelurahan_karame_kecsingkil_1.123';

        $bangunan_id = $this->deletePrefix($kelurahan_id, $request->bangunan_id);

        return response()->json([
            'bangunan_id' => $bangunan_id
        ], 200);

    }

    public function table(Request $request)
    {
        // Validator::make($request->all(), [
        //     'remember_token' => 'required',
        // ], [
        //     'required' => 'The attribute field is required.'
        // ]);
        
        // $kelurahan_id = User::where('remember_token', $request->remember_token)->first()['kelurahan_id'];

        $kelurahan_id = 4;

        $penduduk = Penduduk::select('penduduks.*')
            ->join('bangunans', 'penduduks.bangunan_id', '=', 'bangunans.id')
            ->where('bangunans.kelurahan_id', $kelurahan_id)->get();

        $nik = Penduduk::select('penduduks.nik')
        ->join('bangunans', 'penduduks.bangunan_id', '=', 'bangunans.id')
        ->where('bangunans.kelurahan_id', $kelurahan_id)->get();
        
        // for ($i=0; $i<count($penduduk); $i++) {
        //     $arr = [];
        //     $take = $nik[$i];
        //     array_push($arr, $take);
        // }

        // $take = $nik[1];
        
        // dd($nik);
    
        return response()->json([
            'kelurahan_id' => $kelurahan_id,
            // $take => 'test'
            'test' => $nik
        ], 200);

  
        // for ($i=0; $i < count(); $i++) { 
        //     # code...
        // }
    }

}
