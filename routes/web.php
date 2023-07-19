<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('users')->group(function() {
    Route::prefix('page')->group(function () {
        Route::view('profile', 'user.profile')->name('profile');
        Route::view('login', 'user.login');
    });
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
