<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\TransactionPurposeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportingController;

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


Route::get('/link', function () {        
   $target = '/home/hilsanco/public_html/PettyCash/PettyCash/storage/app/public';
   $shortcut = '/home/hilsanco/public_html/PettyCash/PettyCash/public/storage';
   symlink($target, $shortcut);
});


Route::get('/AuthLogin', [AuthController::class, 'DashboardLogin'])->name('AuthLogPage');
Route::post('/Authcheck',[AuthController::class, 'checkadmin'])->name('auth.admin.check');
Route::get('/Authlogout',[AuthController::class, 'adminlogout'])->name('auth.admin.logout');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin','middleware' => ['AuthCheckAdmins']], function() {});




       // Route::group(['prefix' => 'admins'], function () {

        //Route::get('/', [DashboardController::class, 'dashboard'])->name('admindash');

       
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

Auth::routes();

// Route admin
Route::middleware(['auth', 'user-role:admin'])->prefix('access')->group(function () {

   Route::get('/', [DashboardController::class, 'dashboard'])->name('dash');
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

   Route::get('/TransactionsHistory/{staffId}', [ReportingController::class, 'StaffTransactionReport'])->name('staffTransHistory');
   
   Route::get('/FullTransactionsHistory', [ReportingController::class, 'transactionsReport'])->name('fullTransHistory');

    //Route::get('/home', [HomeController::class, 'userHome'])->name('user.home');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
