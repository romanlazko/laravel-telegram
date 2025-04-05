<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BackgroundFillFreeformGradient extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'color' => 'array',
        ];
    }
}
