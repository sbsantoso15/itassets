<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiListMaster extends Controller
{
    // list cabang
    public function listCabang() {
        $data = DB::table('rfcabang')
            ->select('*')
            ->where('isactive', 1)
            ->orderBy('sortorder', 'asc')
            ->orderBy('kodecab', 'asc')
            ->get();

        if ($data->count() > 0) {
            return response()->json([
                'cabang' => $data,
                'message' => 'Data cabang ditemukan',
                'error' => false,
            ]);        
        }    
    }

    public function listBagian() {
        $data = DB::table('rfukerja')
            ->select('*')
            ->where('isactive', 1)
            ->get();

        if ($data->count() > 0) {
            return response()->json([
                'bagian' => $data,
                'message' => 'Data cabang ditemukan',
                'error' => false,
            ]);
        }  
    }

    public function listTypePc() {
        $data = DB::table('rftypepc')
            ->select('typepc')
            ->where('isactive', 1)
            ->get();

        if ($data->count() > 0) {
            return response()->json([
                'typepc' => $data,
                'message' => 'Type PC ditemukan',
                'error' => false,
            ]);
        }  
    }
}
