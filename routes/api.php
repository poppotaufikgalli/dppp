<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/uploadCK/{folder}', [ApiController::class, 'uploadCK'])->name('api.uploadCK');

Route::get('/getDataKunjungan', [ApiController::class, 'getDataKunjungan'])->name('api.getDataKunjungan');
Route::get('/getListKunjungan', [ApiController::class, 'getListKunjungan'])->name('api.getListKunjungan');