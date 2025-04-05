<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BackgroundFillGradient extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'top_color' => 'integer',
            'bottom_color' => 'integer',
            'rotation_angle' => 'integer',
        ];
    }
}
