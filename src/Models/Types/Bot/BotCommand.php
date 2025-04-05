<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Bot;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BotCommand extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'command' => 'string',
            'description' => 'string',
        ];
    }
}
