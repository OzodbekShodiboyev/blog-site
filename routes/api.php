<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Postcontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth.basic');
Route::get('/posts', [Postcontroller::class, 'index']);