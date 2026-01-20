<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('api-log')
    ->prefix('v1')
    ->as('v1.')
    ->group(function () {
        Route::prefix('books')->group(function () {
            require base_path(path:'routes/Api/V1/books.php');
        });
    });
