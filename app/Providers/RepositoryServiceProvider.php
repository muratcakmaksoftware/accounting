<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterfaces\BaseRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\PayableRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\ReceivableRepositoryInterface;
use App\Models\PaymentMethodType;
use App\Repositories\BaseRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\CurrencyTypeRepository;
use App\Repositories\PayableRepository;
use App\Repositories\PaymentMethodTypeRepository;
use App\Repositories\ReceivableRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(PayableRepositoryInterface::class, PayableRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CurrencyTypeRepositoryInterface::class, CurrencyTypeRepository::class);
        $this->app->bind(PaymentMethodTypeRepositoryInterface::class, PaymentMethodTypeRepository::class);
        $this->app->bind(ReceivableRepositoryInterface::class, ReceivableRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
