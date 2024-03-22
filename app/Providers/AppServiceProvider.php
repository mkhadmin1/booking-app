<?php

namespace App\Providers;



use App\Contracts\IBookingRepository;
use App\Contracts\IUserRepository;
use App\Repositories\BookingRepository;
use App\Repositories\UserRepository;
use App\Contracts\ICityRepository;
use App\Contracts\IFeedbackRepository;
use App\Repositories\CityRepository;
use App\Repositories\FeedbackRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(IUserRepository::class, UserRepository::class);

        $this->app->bind(IFeedbackRepository::class, FeedbackRepository::class);

        $this->app->bind(ICityRepository::class, CityRepository::class);

        $this->app->bind(IBookingRepository::class, BookingRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
