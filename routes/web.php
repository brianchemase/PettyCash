<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\TransactionPurposeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


       // Route::group(['prefix' => 'admins'], function () {

        Route::get('/', [DashboardController::class, 'dashboard'])->name('admindash');

        Route::get('/forms', [DashboardController::class, 'dashboardforms'])->name('adminforms');

        Route::get('/blank', [DashboardController::class, 'blankpage'])->name('blankpage');

        Route::get('/table', [DashboardController::class, 'tablepage'])->name('tablepage');
        Route::get('/StaffManagement', [DashboardController::class, 'managestaff'])->name('managestaff');

        Route::post('/RegisterStaff', [DashboardController::class, 'registerStaff'])->name('savestaffdata');

        //transaction purpose
        Route::get('/RegisterTransactionpurpose', [TransactionPurposeController::class, 'create'])->name('transactionpurposecreate');
        Route::post('/Savetransactionpurpose', [TransactionPurposeController::class, 'RegisterPurpose'])->name('savetransactionpurpose');

        //fund allocation
        Route::get('/StaffFundAllocation', [AllocationsController::class, 'Fundallocation'])->name('fundallocations');
        //save fund allocated
        Route::any('/AllocationFund', [AllocationsController::class, 'allocateFunds'])->name('allocate.funds');

        Route::any('/AllocationFundHistory', [AllocationsController::class, 'getAllocationHistory'])->name('AllocationHistory');

        Route::get('/TransactionsHistory', [TransactionsController::class, 'getTransactionHistory'])->name('TransHistory');
        
    
       // }   );

        

// Route::group(
//     ['prefix' => 'admins'],
//     function () {

//         Route::get('/', [DashboardController::class, 'dashboard'])->name('admindash');

//         Route::get('/forms', [DashboardController::class, 'dashboardforms'])->name('adminforms');

//         Route::get('/blank', [DashboardController::class, 'blankpage'])->name('blankpage');

//         Route::get('/table', [DashboardController::class, 'tablepage'])->name('tablepage');
//     }
// );
