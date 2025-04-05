<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class TextQuote extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'text' => 'string',
            'entities' => CollectionOfType::using(MessageEntity::class),
            'position' => 'integer',
            'is_manual' => 'boolean',
        ];
    }
}
