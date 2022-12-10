<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Queue::failing(function (JobFailed $event) { //Handler hatayi zaten yakaliyor ihtiyac kalmadi ama kullanilabilir diye tutulacak
            throw $event->exception; //Handler a gonderilir.
        });*/
    }
}
