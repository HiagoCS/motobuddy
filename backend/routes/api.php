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

Route::prefix('user')->group(function (){
    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/', function (Request $request) {
            return $request->user();
        });

        Route::put('/update/{id}', "App\Http\Controllers\User\AccountController@update");
        Route::delete('/delete/{id}', "App\Http\Controllers\User\AccountController@delete");
    });
    
    
    Route::post("/login", "App\Http\Controllers\User\AccountController@login");

    Route::post("/store", "App\Http\Controllers\User\AccountController@store");
});
