<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\Admin\WithdrawalController as AdminWithdrawalController;
use App\Http\Controllers\Admin\DepositController as AdminDepositController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\InvestController as AdminInvestController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
// Route::prefix('admin')->group(function () {
    Route::resource('withdrawal', AdminWithdrawalController::class);
    Route::post('/withdrawal/search', [AdminWithdrawalController::class, 'search'])->name('withdrawal.search');
    Route::resource('deposit', AdminDepositController::class);
    Route::resource('order', AdminOrderController::class);
    Route::resource('invest', AdminInvestController::class);
    Route::resource('users', AdminUserController::class);
});

// Route::get('/admin/withdrawal', [AdminWithdrawalController::class,'index'])->name('admin-withdrawal.index');
// Route::get('/admin/withdrawal/{withdrawal}', [AdminWithdrawalController::class,'edit'])->name('admin-withdrawal.edit');
// Route::get('/admin/deposit', [AdminDepositController::class,'index'])->name('admin-deposit.index');
// Route::get('/admin/invest', [AdminInvestController::class,'index'])->name('admin-invest.index');

Route::middleware('auth')->group(function () {
    Route::get('/account',[AccountController::class, 'index'])->name('account');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // withdrawal
    Route::get('/withdraw', [WithdrawalController::class, 'index'])->name('cashout');
    Route::post('/withdraw', [WithdrawalController::class, 'store'])->name('cashout.store');

    // deposit
    Route::get('deposit', [DepositController::class, 'index'])->name('deposit');
    Route::post('deposit', [DepositController::class, 'store'])->name('deposit.store');

    // invest
    Route::get('/invest', [InvestController::class, 'index'])->name('invest');
    Route::post('/invest', [InvestController::class, 'store'])->name('invest.store');
});

require __DIR__ . '/auth.php';
