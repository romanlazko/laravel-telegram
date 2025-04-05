<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ReactionType;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ReactionTypeCustomEmoji extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'custom_emoji_id' => 'string',
        ];
    }
}
