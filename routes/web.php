<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankAccountHistoryController;
use App\Http\Controllers\BankCheckController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrencyTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayableController;
use App\Http\Controllers\PaymentMethodTypeController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\TCMBCurrencyController;
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
        Route::post('/upload-companies', [CompanyController::class, 'uploadCompanies'])->name('companies.upload_companies');
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
        Route::post('/upload-bank-checks', [BankController::class, 'uploadBankChecks'])->name('banks.upload_bank_checks');

        Route::group(['prefix' => '{bankId}/accounts'], function () {
            Route::get('/', [BankAccountController::class, 'index'])->name('bank_accounts.index');
            Route::get('/create', [BankAccountController::class, 'create'])->name('bank_accounts.create');
            Route::post('/', [BankAccountController::class, 'store'])->name('bank_accounts.store');
            Route::get('/{id}/edit', [BankAccountController::class, 'edit'])->name('bank_accounts.edit');
            Route::put('/{id}', [BankAccountController::class, 'update'])->name('bank_accounts.update');
            Route::delete('/{id}', [BankAccountController::class, 'destroy'])->name('bank_accounts.destroy');
            Route::get('/datatables', [BankAccountController::class, 'datatables'])->name('bank_accounts.datatables');
            Route::get('/trashed', [BankAccountController::class, 'trashed'])->name('bank_accounts.trashed');
            Route::get('/trashed-datatables', [BankAccountController::class, 'trashedDatatables'])->name('bank_accounts.trashed_datatables');
            Route::post('/{id}/restore', [BankAccountController::class, 'restore'])->name('bank_accounts.restore');
            Route::delete('/{id}/force-delete', [BankAccountController::class, 'forceDelete'])->name('bank_accounts.force_delete');

            Route::group(['prefix' => '{bankAccountId}/history'], function () {
                Route::get('/', [BankAccountHistoryController::class, 'index'])->name('bank_account_history.index');
                Route::get('/create', [BankAccountHistoryController::class, 'create'])->name('bank_account_history.create');
                Route::post('/', [BankAccountHistoryController::class, 'store'])->name('bank_account_history.store');
                Route::get('/{id}/edit', [BankAccountHistoryController::class, 'edit'])->name('bank_account_history.edit');
                Route::put('/{id}', [BankAccountHistoryController::class, 'update'])->name('bank_account_history.update');
                Route::delete('/{id}', [BankAccountHistoryController::class, 'destroy'])->name('bank_account_history.destroy');
                Route::get('/datatables', [BankAccountHistoryController::class, 'datatables'])->name('bank_account_history.datatables');
                Route::get('/trashed', [BankAccountHistoryController::class, 'trashed'])->name('bank_account_history.trashed');
                Route::get('/trashed-datatables', [BankAccountHistoryController::class, 'trashedDatatables'])->name('bank_account_history.trashed_datatables');
                Route::post('/{id}/restore', [BankAccountHistoryController::class, 'restore'])->name('bank_account_history.restore');
                Route::delete('/{id}/force-delete', [BankAccountHistoryController::class, 'forceDelete'])->name('bank_account_history.force_delete');
            });
        });

        Route::group(['prefix' => '{bankId}/checks'], function () {
            Route::get('/', [BankCheckController::class, 'index'])->name('bank_checks.index');
            Route::get('/create', [BankCheckController::class, 'create'])->name('bank_checks.create');
            Route::post('/', [BankCheckController::class, 'store'])->name('bank_checks.store');
            Route::get('/{id}/edit', [BankCheckController::class, 'edit'])->name('bank_checks.edit');
            Route::put('/{id}', [BankCheckController::class, 'update'])->name('bank_checks.update');
            Route::delete('/{id}', [BankCheckController::class, 'destroy'])->name('bank_checks.destroy');
            Route::get('/datatables', [BankCheckController::class, 'datatables'])->name('bank_checks.datatables');
            Route::get('/trashed', [BankCheckController::class, 'trashed'])->name('bank_checks.trashed');
            Route::get('/trashed-datatables', [BankCheckController::class, 'trashedDatatables'])->name('bank_checks.trashed_datatables');
            Route::post('/{id}/restore', [BankCheckController::class, 'restore'])->name('bank_checks.restore');
            Route::delete('/{id}/force-delete', [BankCheckController::class, 'forceDelete'])->name('bank_checks.force_delete');
        });
    });

    Route::group(['prefix' => '/tcmb-currencies'], function () {
        Route::get('/', [TCMBCurrencyController::class, 'index'])->name('tcmb_currenies.index');
        Route::delete('/{id}', [TCMBCurrencyController::class, 'destroy'])->name('tcmb_currenies.destroy');
        Route::get('/datatables', [TCMBCurrencyController::class, 'datatables'])->name('tcmb_currenies.datatables');
    });
});
