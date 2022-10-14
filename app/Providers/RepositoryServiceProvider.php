<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterfaces\BaseRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\PayableRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\PayableRepository;
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
