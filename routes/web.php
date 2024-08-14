<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyTypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PaymentVoucherController;
use App\Http\Controllers\ReceiptVoucherController;

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
Route::get('/clear', function() {
    //   $mytime = Carbon\Carbon::now();
    //  return $mytime->toDateTimeString();
    $exitCode = Artisan::call('cache:clear');
     $exitCode = Artisan::call('config:clear');
     $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>cleared</h1>';
});
Route::get('/', function () {
    return view('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard');
    // Route::resource('company-type', CompanyTypeController::class);
    // Route::resource('store', StoreController::class);
    
    Route::resource('expense-master', ExpenseController::class);
    Route::resource('payment-voucher', PaymentVoucherController::class);
    Route::get('profile-update', [StoreController::class,'edit'])->name('profile-update');
    Route::get('pending-expense', [ExpenseController::class,'pending_expense']);
    Route::get('expense-view/{id}', [ExpenseController::class,'expense_view']);

    Route::get('payment-voucher-report', [PaymentVoucherController::class,'payment_voucher_report']);
    Route::resource('income-master', IncomeController::class);
    Route::resource('receipt-voucher', ReceiptVoucherController::class);
    Route::get('receipt-voucher-report', [ReceiptVoucherController::class,'receipt_voucher_report']);
    Route::get('monthly-share-report', [MainController::class,'monthly_share_report']);
    Route::get('monthly-report-detail/{id}', [MainController::class,'monthly_report_detail'])->name('monthly-report-detail/');
    
    
});

require __DIR__.'/auth.php';
