<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\transferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\withdrawalController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::post('/withdraw', [withdrawalController::class, 'index']);
Route::post('/transfer', [transferController::class, 'index']);
Route::get('/transaction_histories', [TransactionHistoryController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::put('/user', [UserController::class, 'update']);
