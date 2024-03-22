<?php

namespace App\Providers;


use App\Contracts\IUserRepository;
use App\Repositories\UserRepository;
use App\Contracts\IFeedbackRepository;
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

        //

        $this->app->bind(IFeedbackRepository::class, FeedbackRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
