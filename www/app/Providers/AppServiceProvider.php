<?php

namespace App\Providers;

use App\Http\Controllers\WebhookController;
use App\Services\TelegramConfig;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(WebhookController::class)->needs(LoggerInterface::class)->give(function () {
            return Log::channel('webhook');
        });

        $this->app->bind(TelegramConfig::class, function () {
            return new TelegramConfig(
                config('telegram.token'),
                config('telegram.secretToken')
            );
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
