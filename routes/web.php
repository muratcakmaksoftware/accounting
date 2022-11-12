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
        Route::get('/trashed', [PayableController::class, 'trashed'])->name('payables.trashed');
        Route::get('/trashed-datatables', [PayableController::class, 'trashedDatatables'])->name('payables.trashed.datatables');
        Route::post('/{id}/restore', [PayableController::class, 'restore'])->name('payables.restore');
        Route::delete('/{id}/force-delete', [PayableController::class, 'forceDelete'])->name('payables.force.delete');
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
        Route::get('/trashed-datatables', [ReceivableController::class, 'trashedDatatables'])->name('receivables.trashed.datatables');
        Route::post('/{id}/restore', [ReceivableController::class, 'restore'])->name('receivables.restore');
        Route::delete('/{id}/force-delete', [ReceivableController::class, 'forceDelete'])->name('receivables.force.delete');
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
        Route::get('/trashed-datatables', [CompanyController::class, 'trashedDatatables'])->name('companies.trashed.datatables');
        Route::post('/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
        Route::delete('/{id}/force-delete', [CompanyController::class, 'forceDelete'])->name('companies.force.delete');
    });

    Route::group(['prefix' => '/company'], function () {
        Route::get('/select2Ajax', [CompanyController::class, 'select2Ajax'])->name('companies.select2Ajax');
    });
});
