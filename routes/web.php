<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\AllocationsController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(
    ['prefix' => 'admins'],
    function () {

        Route::get('/', [DashboardController::class, 'dashboard'])->name('admindash');

        Route::get('/forms', [DashboardController::class, 'dashboardforms'])->name('adminforms');

        Route::get('/blank', [DashboardController::class, 'blankpage'])->name('blankpage');

        Route::get('/table', [DashboardController::class, 'tablepage'])->name('tablepage');
    }
);
