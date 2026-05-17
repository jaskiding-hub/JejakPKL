<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndustriApiController;
use App\Http\Controllers\Api\PengalamanApiController;

// ==================== INDUSTRI API ====================
Route::apiResource('industri', IndustriApiController::class);

// ==================== PENGALAMAN PKL API ====================
Route::apiResource('pengalaman', PengalamanApiController::class);