<?php

use App\Http\Controllers\GeneralController;
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

Route::get('/', [GeneralController::class, 'home'])->name('home');
Route::post('/login', [GeneralController::class, 'login'])->name('login');
Route::post('/logout', [GeneralController::class, 'logout'])->name('logout');

