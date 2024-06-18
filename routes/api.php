<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QrController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/qr/generate',[QrController::class,'generateQR']);
    Route::post('/qr/status',[QrController::class,'statusQR']);
    Route::post('/balance',[AccountController::class,'getBalance']);
});


Route::get('/method',function(Request $request){
    return $request->user();
});

