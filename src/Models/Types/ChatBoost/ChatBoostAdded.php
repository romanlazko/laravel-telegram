<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ChatBoostAdded extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'boost_count' => 'integer',
        ];
    }
}
