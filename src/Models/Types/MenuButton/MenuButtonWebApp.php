<?php

namespace Romanlazko\LaravelTelegram\Models\Types\MenuButton;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Keyboard\WebAppInfo;

class MenuButtonWebApp extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'text' => 'string',
            'web_app' => Type::using(WebAppInfo::class),
        ];
    }
}
