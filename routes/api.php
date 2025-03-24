<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimOfferController;
use App\Http\Controllers\UserCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(
  function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/offers', [UserOfferController::class, 'index']);
    Route::get('/users/codes', [UserCodeController::class, 'index']);
    Route::patch('/codes/{code}/redeem', [UserCodeController::class, 'redeem']);
    Route::post('/offers/{offer}/claim', [ClaimOfferController::class, 'store']);
  }
);
