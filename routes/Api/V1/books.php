<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->group(function () {
    //
Route::get('/',\App\Http\Controllers\Api\V1\Books\IndexController::class);
Route::post('/store',\App\Http\Controllers\Api\V1\Books\StoreBookController::class);
});
