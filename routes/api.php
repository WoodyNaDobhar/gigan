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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['verified'])->group(function () {

    Route::resource('challenges', App\Http\Controllers\API\ChallengeAPIController::class);


    Route::resource('kingdoms', App\Http\Controllers\API\KingdomAPIController::class);


    Route::resource('lands', App\Http\Controllers\API\LandAPIController::class);


    Route::resource('users', App\Http\Controllers\API\UserAPIController::class);


    Route::resource('weeks', App\Http\Controllers\API\WeekAPIController::class);

});


Route::resource('flexers', App\Http\Controllers\API\FlexerAPIController::class);
