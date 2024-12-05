<?php

use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('users')->group(function (){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/insert', [UserController::class,'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
});

Route::prefix('wallet')->group(function (){
    Route::get('/', [WalletController::class, 'index']);
    Route::post('/insert', [WalletController::class,'store']);
    Route::get('/{id}', [WalletController::class,'show']);
    Route::put('/update/{id}', [WalletController::class, 'update']);
    Route::delete('/delete/{id}', [WalletController::class, 'destroy']);
});

Route::prefix('transactions')->group(function (){
    Route::get('/', [TransactionsController::class, 'index']);
    Route::post('/insert', [TransactionsController::class,'store']);
    Route::get('/{id}', [TransactionsController::class,'show']);
    Route::put('/update/{id}', [TransactionsController::class, 'update']);
    Route::delete('/delete/{id}', [TransactionsController::class, 'destroy']);
});


