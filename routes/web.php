<?php

use App\Http\Controllers\Access\ForgoutController;
use App\Http\Controllers\Access\LoginController;
use App\Http\Controllers\Access\RegisterController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Product\IncomeController;
use App\Http\Controllers\Product\PackageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Trader\InvestimentController;
use App\Http\Controllers\Trader\TraderController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Wallet\TransferController;
use App\Http\Controllers\Wallet\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('logon', [LoginController::class, 'logon'])->name('logon');

Route::get('register/{indicator?}', [RegisterController::class, 'register'])->name('register');
Route::post('registrer', [RegisterController::class, 'registrer'])->name('registrer');

Route::get('forgout/{code?}', [ForgoutController::class, 'index'])->name('forgout');
Route::post('generate-code', [ForgoutController::class, 'generateCode'])->name('generate-code');
Route::post('reset-password', [ForgoutController::class, 'resetPassword'])->name('reset-password');

Route::middleware(['auth'])->group(function () {

    Route::get('app', [AppController::class, 'app'])->name('app');

    Route::get('trader/{uuid}', [TraderController::class, 'index'])->name('trader');
    Route::post('investiment-create', [TraderController::class, 'createInvestiment'])->name('investiment-create');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::get('wallet/{uuid}', [WalletController::class, 'index'])->name('wallet');
    Route::get('wallet-investiment/{uuid}', [WalletController::class, 'walletInvestment'])->name('wallet-investiment');

    Route::get('transfer', [TransferController::class, 'index'])->name('transfer');
    Route::post('transfer-send', [TransferController::class, 'transferSend'])->name('transfer-send');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('product-create', [ProductController::class, 'create'])->name('product-create');
    Route::post('product-create', [ProductController::class, 'store'])->name('product-store');
    Route::get('product-show/{uuid}', [ProductController::class, 'show'])->name('product-show');
    Route::post('product-update/{id}', [ProductController::class, 'update'])->name('product-update');
    Route::post('product-delete/{id}', [ProductController::class, 'delete'])->name('product-delete');

    Route::get('packages/{product}', [PackageController::class, 'index'])->name('packages');
    Route::post('package-create', [PackageController::class, 'store'])->name('package-create');
    Route::post('package-update', [PackageController::class, 'update'])->name('package-update');
    Route::post('package-delete', [PackageController::class, 'delete'])->name('package-delete');

    Route::get('investiments/{product}', [InvestimentController::class, 'index'])->name('investiments');
    Route::post('investiment-update', [InvestimentController::class, 'update'])->name('investiment-update');
    Route::post('investiment-delete', [InvestimentController::class, 'delete'])->name('investiment-delete');

    Route::get('incomes/{product}', [IncomeController::class, 'index'])->name('incomes');
    Route::post('income-update', [IncomeController::class, 'update'])->name('income-update');
    Route::post('income-delete', [IncomeController::class, 'delete'])->name('income-delete');

    Route::get('users', [UserController::class, 'users'])->name('users');
    Route::get('user-show/{uuid}', [UserController::class, 'index'])->name('user-show');
    Route::post('user-update/{uuid}', [UserController::class, 'update'])->name('user-update');
    Route::post('user-delete/{uuid}', [UserController::class, 'delete'])->name('user-delete');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});