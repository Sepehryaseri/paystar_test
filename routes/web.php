<?php

use App\Http\Controllers\Ipg\CallbackController;
use App\Http\Controllers\Ipg\PaymentController;
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
        Route::view('profile', 'user.profile')->name('profile')->middleware('auth');
        Route::view('login', 'user.login')->name('login_page');
    });
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('payments')->group(function () {
        Route::post('', [PaymentController::class, 'createTransaction'])->name('payment');
    });

    Route::post('ipg/callback', [CallbackController::class, 'callback']);
});
