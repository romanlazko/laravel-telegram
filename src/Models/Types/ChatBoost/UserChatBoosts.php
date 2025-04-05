<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class UserChatBoosts extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'boosts' => CollectionOfType::using(ChatBoost::class),
        ];
    }
}
