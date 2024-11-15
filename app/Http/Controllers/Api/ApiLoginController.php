<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiLoginController extends Controller
{
    // login
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'userid'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('userid', 'password');

        //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'User ID atau Password Anda salah'
            ], 401);
        }

        //if auth success
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),    
            'token'   => $token   
        ], 200);
    }

    public function logout() {
    //remove token
    $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

    if($removeToken) {
        //return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil!',  
        ]);
            
        }
    }
}
