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

Route::middleware('admin')->get('test', function() {
    return '1000';
});
Route::prefix('admin')->namespace('Admin')->middleware(['auth:api', 'admin'])->group(function () {
    Route::namespace('User')->prefix('user')->group(function () {
        Route::apiResource('/', 'UserController');
    });
});