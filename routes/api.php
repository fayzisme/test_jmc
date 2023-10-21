<?php

use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProvinsiController;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('provinsi')->group( function(){
    Route::get('/list', [ProvinsiController::class, 'api'])->name('api.provinsi.list');
});

Route::prefix('kabupaten')->group( function(){
    Route::get('/list', [KabupatenController::class, 'api'])->name('api.kabupaten.list');
});

Route::prefix('penduduk')->group( function(){
    Route::get('/list', [PendudukController::class, 'api'])->name('api.penduduk.list');
    Route::get('/total', [PendudukController::class, 'total'])->name('api.penduduk.total');
});
