<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiListAssets;
use App\Http\Controllers\Api\ApiListMaster;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', [ApiLoginController::class,'login'])->name('api.login');
Route::post('/logout', [ApiLoginController::class, 'logout'])->name('api.logout');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group( function () {
    Route::get('/index', [ApiListAssets::class, 'index'])->name('api.index');
    Route::get('/listAllAssets', [ApiListAssets::class,'listAllAssets'])->name('api.listAllAssets');
    Route::get('/listAssets/{kodecab}', [ApiListAssets::class,'listAssets'])->name('api.listAssets');
    Route::get('/getAssets/{noseri}', [ApiListAssets::class,'getAssets'])->name('api.getAssets');
    Route::post('/storeAssets', [ApiListAssets::class,'storeAssets'])->name('api.storeAssets');

    Route::get('/listCabang', [ApiListMaster::class,'listCabang'])->name('api.listCabang');
    Route::get('/listBagian', [ApiListMaster::class,'listBagian'])->name('api.listBagian');
    Route::get('/listTypePc', [ApiListMaster::class,'listTypePc'])->name('api.listTypePc');
});

