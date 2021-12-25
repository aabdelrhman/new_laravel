<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use App\Observers\brandObserver;
use App\Observers\productObsrever;
use App\Observers\sectionObsrever;
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
        Product::observe(productObsrever::class);
        Section::observe(sectionObsrever::class);
        Brand::observe(brandObserver::class);
    }
}
