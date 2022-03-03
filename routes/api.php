<?php

use App\Http\Controllers\RandomsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'randoms'], function() {
    Route::post('/', [RandomsController::class, 'create']);
    Route::get('/', [RandomsController::class, 'randoms']);
});