<?php

namespace App\Providers;

use App\Models\BankAccount;
use App\Models\Company;
use App\Models\CurrencyType;
use App\Models\PaymentMethodType;
use App\Observers\BankAccountObserver;
use App\Observers\CompanyObserver;
use App\Observers\CurrencyTypeObserver;
use App\Observers\PaymentMethodTypeObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Company::observe(CompanyObserver::class);
        CurrencyType::observe(CurrencyTypeObserver::class);
        PaymentMethodType::observe(PaymentMethodTypeObserver::class);
        BankAccount::observe(BankAccountObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
