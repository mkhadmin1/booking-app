<?php

namespace App\Providers;
use App\Contracts\ICityRepository;
use App\Contracts\IBookingRepository;
use App\Contracts\IHotelRepository;
use App\Contracts\IUserRepository;
use App\Contracts\IFeedbackRepository;
use App\Contracts\IRoomRepository;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;
use App\Repositories\UserRepository;
use App\Repositories\CityRepository;
use App\Repositories\FeedbackRepository;
use App\Repositories\RoomRepository;
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
        $this->app->bind(IRoomRepository::class, RoomRepository::class);
        $this->app->bind(IBookingRepository::class, BookingRepository::class);
        $this->app->bind(IHotelRepository::class, HotelRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
