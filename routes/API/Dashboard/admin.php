<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::namespace('Auth')->prefix('auth')->group(function() {
        Route::post('login', 'AuthController@login');
    });
});

Route::prefix('admin')->namespace('Admin')->middleware(['auth:api', 'admin'])->group(function () {
    Route::namespace('Auth')->prefix('auth')->group(function() {
        Route::post('logout', 'AuthController@logout');
    });
});
