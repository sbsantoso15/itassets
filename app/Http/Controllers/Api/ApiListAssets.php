<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiListAssets extends Controller
{
    public function index() {
        $domain = DB::table('tblassets')
            ->where('isdomain', 1)
            ->where('hwcode', 'PC')
            ->where('isactive', 1)
            ->count('noseri');
        $nondomain = DB::table('tblassets')
            ->where('isdomain', 0)
            ->where('hwcode', 'PC')
            ->where('isactive', 1)
            ->count('noseri');
        return response()->json([
            'domain' => $domain, 
            'nondomain' => $nondomain,
            'message' => 'Data assets ditemukan',
            'error' => false,
        ], 200);
    }

    // list all aset
    public function listAllAssets() {
        $data = DB::table('tblassets')
            ->select('*')
            ->get();
        if ($data->count() > 0) {
            return response()->json([
                'assets' => $data,
                'message' => 'Data assets ditemukan',
                'error' => false,
            ], 200);
        } else {
            return response()->json([
                'assets' => null,
                'message' => 'Data assets tidak ditemukan',
                'error' => true,
            ], 401);
        }
    }    
    
    // list aset by cabang
    public function listAssets(Request $request) {
        $data = DB::table('tblassets')
            ->select('*')
            ->where('kodecab', $request->kodecab)
            ->get();

        if ($data->count() > 0) {
            return response()->json([
                'assets' => $data,
                'message' => 'Data assets ditemukan',
                'error' => false,
            ]);
        } else {
            return response()->json([
                'assets' => null,
                'message' => 'Data assets tidak ditemukan',
                'error' => true,
            ]);
        }
    }

        // get aset by noseri
    public function getAssets(Request $request, $noseri) {
        $data = DB::table('tblassets')
            ->select('*')
            ->where('noseri', $request->noseri)
            ->get();

        if ($data->count() > 0) {
            return response()->json([
                'assets' => $data,
                'message' => 'Data assets ditemukan',
                'error' => false,
            ]);
        } else {
            return response()->json([
                'assets' => null,
                'message' => 'Data assets tidak ditemukan',
                'error' => true,
            ]);
        }
    }

    public function storeAssets(Request $request) {
        //$data=json_decode($request->input('datajson'));
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'noseri'     => 'required',
            'kodecab'   => 'required',
            'hwtype'   => 'required',
        ],
            [
                'noseri.required' => 'Masukkan No Seri !',
                'kodecab.required' => 'Masukkan Cabang !',
                'hwtype.required' => 'Masukkan Type H/W !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);
        } else {
            DB::begintransaction();
            try {
                $onok = DB::table('tblassets')
                    ->select('noseri')
                    ->where('noseri', $data['noseri'])
                    ->first();
                if (empty($onok)) {
                    // insert
                    DB::table('tblassets')
                    ->insert([
                        'noseri' => $data['noseri'],
                        'kodecab' => $data['kodecab'],
                        'hwtype' => $data['hwtype'],
                    ]);
                    return response()->json([
                        'error' => false,
                        'message' => 'Save data asset successfully !' ,
                        'data'    => $data,
                    ], 200);
                } else {
                    DB::table('tblassets')
                    ->update([
                        //'noseri' => $data['noseri'],
                        'kodecab' => $data['kodecab'],
                        'hwtype' => $data['hwtype'],
                    ]);
                    return response()->json([
                        'error' => true,
                        'message' => 'Update successfuly !' ,
                        'data'    => $data,
                    ], 200);
                }
                DB::commit();
            }
            catch (\Throwable $e) {
                DB::rollback();
                return response()->json([
                    'error' => true,
                    'message' => 'Save data asset failed !' . $e->getMessage(),
                    'data'    => $validator->errors()
                ],401);
            }
        }
    }
}
