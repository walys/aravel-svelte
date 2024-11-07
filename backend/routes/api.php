<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\SituationController;
use App\Http\Controllers\Api\V1\TaskController;

Route::prefix('V1')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::resources(['users' => UserController::class]);
        Route::resources(['situation' => SituationController::class]);
        Route::resources(['task' => TaskController::class]);
    });
});
