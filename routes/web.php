<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayableController;
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
    });

    Route::group(['prefix' => '/receivables'], function () {
        Route::get('/', [ReceivableController::class, 'index'])->name('receivables.index');
        Route::get('/create', [ReceivableController::class, 'create'])->name('receivables.create');
        Route::post('/', [ReceivableController::class, 'store'])->name('receivables.store');
        Route::get('/{id}/edit', [ReceivableController::class, 'edit'])->name('receivables.edit');
        Route::put('/{id}', [ReceivableController::class, 'update'])->name('receivables.update');
        Route::delete('/{id}', [ReceivableController::class, 'destroy'])->name('receivables.destroy');
        Route::get('/datatables', [ReceivableController::class, 'datatables'])->name('receivables.datatables');
    });

    Route::group(['prefix' => '/company'], function () {
        Route::get('/select2Ajax', [CompanyController::class, 'select2Ajax'])->name('companies.select2Ajax');
    });
});
