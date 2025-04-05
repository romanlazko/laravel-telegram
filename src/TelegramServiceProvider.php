<?php

namespace Romanlazko\LaravelTelegram;

use Illuminate\Support\ServiceProvider;
use Romanlazko\LaravelTelegram\Console\Commands\MakeCommandCommand;
use Romanlazko\LaravelTelegram\Console\Commands\MakeTelegramBotCommand;

class TelegramServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCommandCommand::class,
                MakeTelegramBotCommand::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/routes/telegram.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishesMigrations([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'laravel-telegram-migrations');
    }
}
