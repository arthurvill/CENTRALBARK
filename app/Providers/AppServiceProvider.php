<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Paginator::useBootstrap();

        view()->share('our_services', Service::pluck('name', 'id')); // uncomment this
        view()->share('settings', Setting::first()); // uncomment this
        
        view()->share('app_name', config('app.name'));

        view()->composer('*', function ($view) {

            $auth_user = Auth::user();
            if ($auth_user && $auth_user->hasRole('admin')) {

                $view->with('pending_bookings', Booking::with('pet.customer')->where('status', Booking::PENDING)->get());
            } 
        });

    }
}   