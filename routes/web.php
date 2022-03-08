<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
	return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/admin');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::middleware(['verified'])->group(function () {

    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('challenges', App\Http\Controllers\ChallengeController::class);

    Route::resource('flexers', App\Http\Controllers\FlexerController::class);

    Route::resource('kingdoms', App\Http\Controllers\KingdomController::class);

    Route::resource('lands', App\Http\Controllers\LandController::class);

    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::resource('weeks', App\Http\Controllers\WeekController::class);

});

