<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message\MessageOrigin;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MessageOriginHiddenUser extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'date' => 'datetime',
            'sender_user_name' => 'string',
        ];
    }
}
