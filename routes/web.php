<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\QrController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/qr',fn()=>view('qr'));
    // Route::get('/q',fn()=>auth()->user());
    Route::get('/getToken',[AccountController::class,'getToken']);
    Route::post('/scan',[QrController::class,'scanQr'])->name('scan');
});

