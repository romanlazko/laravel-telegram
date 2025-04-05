<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class ChatBackground extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => Type::using(BackgroundType::class),
        ];
    }
}
