<?php

namespace App\Providers;

use App\Contracts\ICityRepository;
use App\Contracts\IFeedbackRepository;
use App\Contracts\IRoomRepository;
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
        $this->app->bind(IFeedbackRepository::class, FeedbackRepository::class);
        $this->app->bind(ICityRepository::class, CityRepository::class);
        $this->app->bind(IRoomRepository::class, RoomRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
