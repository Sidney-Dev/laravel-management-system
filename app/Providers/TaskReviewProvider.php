<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TaskReviewService;

class TaskReviewProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->singleton(TaskReviewService::class, function ($app) {
        //     return new TaskReviewService();
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
