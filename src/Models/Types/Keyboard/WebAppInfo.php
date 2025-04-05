<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Keyboard;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class WebAppInfo extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'url' => 'string',
        ];
    }
}
