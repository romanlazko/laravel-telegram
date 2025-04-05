<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Bot;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BotDescription extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'description' => 'string',
        ];
    }
}
