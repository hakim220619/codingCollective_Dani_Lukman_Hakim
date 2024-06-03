<?php

use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/getToken', [GeneralController::class, 'getToken'])->name('getToken');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/saldo', [GeneralController::class, 'saldo'])->name('saldo');
    Route::get('/deposit', [GeneralController::class, 'deposit'])->name('deposit');
    Route::post('/inputDeposit', [GeneralController::class, 'inputDeposit'])->name('inputDeposit');
    Route::post('/withdrawal', [GeneralController::class, 'withdrawal'])->name('withdrawal');
});
