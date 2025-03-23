<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(
  function () {
    Route::post('/logout', [AuthController::class, 'logout']);
  }
);
