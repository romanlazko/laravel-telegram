<?php

use Illuminate\Support\Facades\Route;
use Romanlazko\LaravelTelegram\Http\Controllers\WebhookController;

Route::middleware(['api'])->prefix('api')->group(function () {
    Route::post('telegram-webhook/{telegram_bot:telegram_bot_id}', WebhookController::class);
});