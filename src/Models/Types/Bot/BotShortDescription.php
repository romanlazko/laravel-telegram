<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Bot;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BotShortDescription extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'short_description' => 'string',
        ];
    }
}
