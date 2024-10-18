<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $observers = [
        \App\Models\Category::class => [
            \App\Observers\CategoryObserver::class
        ],
        \App\Models\Customer::class => [
            \App\Observers\CustomerObserver::class
        ],
        \App\Models\PaymentMethod::class => [
            \App\Observers\PaymentMethodObserver::class
        ],
        \App\Models\Pet::class => [
            \App\Observers\PetObserver::class
        ],
        \App\Models\Prescription::class => [
            \App\Observers\PrescriptionObserver::class
        ],
        \App\Models\Result::class => [
            \App\Observers\ResultObserver::class
        ],
        \App\Models\ServiceCategory::class => [
            \App\Observers\ServiceCategoryObserver::class
        ],
        \App\Models\Service::class => [
            \App\Observers\ServiceObserver::class
        ],
        \App\Models\Staff::class => [
            \App\Observers\StaffObserver::class
        ],
    ];

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
        //
    }
}