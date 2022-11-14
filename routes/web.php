<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrencyTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayableController;
use App\Http\Controllers\PaymentMethodTypeController;
use App\Http\Controllers\ReceivableController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () { //, 'namespace' => 'Auth', 'middleware' => 'auth'
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => '/payables'], function () {
        Route::get('/', [PayableController::class, 'index'])->name('payables.index');
        Route::get('/create', [PayableController::class, 'create'])->name('payables.create');
        Route::post('/', [PayableController::class, 'store'])->name('payables.store');
        Route::get('/{id}/edit', [PayableController::class, 'edit'])->name('payables.edit');
        Route::put('/{id}', [PayableController::class, 'update'])->name('payables.update');
        Route::delete('/{id}', [PayableController::class, 'destroy'])->name('payables.destroy');
        Route::get('/datatables', [PayableController::class, 'datatables'])->name('payables.datatables');
        Route::get('/trashed', [PayableController::class, 'trashed'])->name('payables.trashed');
        Route::get('/trashed-datatables', [PayableController::class, 'trashedDatatables'])->name('payables.trashed_datatables');
        Route::post('/{id}/restore', [PayableController::class, 'restore'])->name('payables.restore');
        Route::delete('/{id}/force-delete', [PayableController::class, 'forceDelete'])->name('payables.force_delete');
    });

    Route::group(['prefix' => '/receivables'], function () {
        Route::get('/', [ReceivableController::class, 'index'])->name('receivables.index');
        Route::get('/create', [ReceivableController::class, 'create'])->name('receivables.create');
        Route::post('/', [ReceivableController::class, 'store'])->name('receivables.store');
        Route::get('/{id}/edit', [ReceivableController::class, 'edit'])->name('receivables.edit');
        Route::put('/{id}', [ReceivableController::class, 'update'])->name('receivables.update');
        Route::delete('/{id}', [ReceivableController::class, 'destroy'])->name('receivables.destroy');
        Route::get('/datatables', [ReceivableController::class, 'datatables'])->name('receivables.datatables');
        Route::get('/trashed', [ReceivableController::class, 'trashed'])->name('receivables.trashed');
        Route::get('/trashed-datatables', [ReceivableController::class, 'trashedDatatables'])->name('receivables.trashed_datatables');
        Route::post('/{id}/restore', [ReceivableController::class, 'restore'])->name('receivables.restore');
        Route::delete('/{id}/force-delete', [ReceivableController::class, 'forceDelete'])->name('receivables.force_delete');
    });

    Route::group(['prefix' => '/companies'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
        Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/{id}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');
        Route::get('/datatables', [CompanyController::class, 'datatables'])->name('companies.datatables');
        Route::get('/trashed', [CompanyController::class, 'trashed'])->name('companies.trashed');
        Route::get('/trashed-datatables', [CompanyController::class, 'trashedDatatables'])->name('companies.trashed_datatables');
        Route::post('/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
        Route::delete('/{id}/force-delete', [CompanyController::class, 'forceDelete'])->name('companies.force_delete');
        //Route::get('/select2Ajax', [CompanyController::class, 'select2Ajax'])->name('companies.select2Ajax');
    });

    Route::group(['prefix' => '/currency-types'], function () {
        Route::get('/', [CurrencyTypeController::class, 'index'])->name('currency_types.index');
        Route::get('/create', [CurrencyTypeController::class, 'create'])->name('currency_types.create');
        Route::post('/', [CurrencyTypeController::class, 'store'])->name('currency_types.store');
        Route::get('/{id}/edit', [CurrencyTypeController::class, 'edit'])->name('currency_types.edit');
        Route::put('/{id}', [CurrencyTypeController::class, 'update'])->name('currency_types.update');
        Route::delete('/{id}', [CurrencyTypeController::class, 'destroy'])->name('currency_types.destroy');
        Route::get('/datatables', [CurrencyTypeController::class, 'datatables'])->name('currency_types.datatables');
        Route::get('/trashed', [CurrencyTypeController::class, 'trashed'])->name('currency_types.trashed');
        Route::get('/trashed-datatables', [CurrencyTypeController::class, 'trashedDatatables'])->name('currency_types.trashed_datatables');
        Route::post('/{id}/restore', [CurrencyTypeController::class, 'restore'])->name('currency_types.restore');
        Route::delete('/{id}/force-delete', [CurrencyTypeController::class, 'forceDelete'])->name('currency_types.force_delete');
    });

    Route::group(['prefix' => '/payment-method-types'], function () {
        Route::get('/', [PaymentMethodTypeController::class, 'index'])->name('payment_method_types.index');
        Route::get('/create', [PaymentMethodTypeController::class, 'create'])->name('payment_method_types.create');
        Route::post('/', [PaymentMethodTypeController::class, 'store'])->name('payment_method_types.store');
        Route::get('/{id}/edit', [PaymentMethodTypeController::class, 'edit'])->name('payment_method_types.edit');
        Route::put('/{id}', [PaymentMethodTypeController::class, 'update'])->name('payment_method_types.update');
        Route::delete('/{id}', [PaymentMethodTypeController::class, 'destroy'])->name('payment_method_types.destroy');
        Route::get('/datatables', [PaymentMethodTypeController::class, 'datatables'])->name('payment_method_types.datatables');
        Route::get('/trashed', [PaymentMethodTypeController::class, 'trashed'])->name('payment_method_types.trashed');
        Route::get('/trashed-datatables', [PaymentMethodTypeController::class, 'trashedDatatables'])->name('payment_method_types.trashed_datatables');
        Route::post('/{id}/restore', [PaymentMethodTypeController::class, 'restore'])->name('payment_method_types.restore');
        Route::delete('/{id}/force-delete', [PaymentMethodTypeController::class, 'forceDelete'])->name('payment_method_types.force_delete');
    });

    Route::group(['prefix' => '/banks'], function () {
        Route::get('/', [BankController::class, 'index'])->name('banks.index');
        Route::get('/create', [BankController::class, 'create'])->name('banks.create');
        Route::post('/', [BankController::class, 'store'])->name('banks.store');
        Route::get('/{id}/edit', [BankController::class, 'edit'])->name('banks.edit');
        Route::put('/{id}', [BankController::class, 'update'])->name('banks.update');
        Route::delete('/{id}', [BankController::class, 'destroy'])->name('banks.destroy');
        Route::get('/datatables', [BankController::class, 'datatables'])->name('banks.datatables');
        Route::get('/trashed', [BankController::class, 'trashed'])->name('banks.trashed');
        Route::get('/trashed-datatables', [BankController::class, 'trashedDatatables'])->name('banks.trashed_datatables');
        Route::post('/{id}/restore', [BankController::class, 'restore'])->name('banks.restore');
        Route::delete('/{id}/force-delete', [BankController::class, 'forceDelete'])->name('banks.force_delete');
    });

});
