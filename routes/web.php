<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Telegram\TelegramController;
use App\Http\Controllers\Telegram\WebhookController;
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

Route::prefix('/telegram')->group(function () {
    Route::any('/webhook', WebhookController::class)->name('telegram.webhook');
    Route::get('/store', [TelegramController::class, 'store'])->name('telegram.store');
});

Route::prefix('/webapp')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('webapp.index');
    Route::middleware(['verify.telegram.data'])->group(function () {
       Route::get('/home', [HomeController::class, 'view'])->name('webapp.home');
    });
});
