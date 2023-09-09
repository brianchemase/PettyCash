<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionPurposeController;
use App\Http\Controllers\TransactionsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/Authenticate', [AuthController::class, 'login']);

Route::get('/TransactionPurposes', [TransactionPurposeController::class, 'transactionsRegistered']);

Route::get('/TransactionHistory/{staff_id}', [TransactionsController::class, 'getStaffTransactionHistory']);

Route::get('/WithDrawalLimit/{staff_id}', [TransactionsController::class, 'getStaffWithdrawalLimit']);

//accept payment
Route::post('/ProcessWithdrawal', [TransactionsController::class, 'processPayment']);

