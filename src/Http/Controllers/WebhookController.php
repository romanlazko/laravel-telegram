<?php

namespace Romanlazko\LaravelTelegram\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Romanlazko\LaravelTelegram\Models\TelegramBot;

class WebhookController extends Controller
{
    public function __invoke(Request $request, TelegramBot $telegramBot)
    {
        try {
            app($telegramBot->name)->processRequest($request);
        } catch (\Throwable|\Error|\Exception $throwable) {
            Log::info($throwable);
        } finally {
            return response()->json(['ok' => true]);
        }
    }
}
