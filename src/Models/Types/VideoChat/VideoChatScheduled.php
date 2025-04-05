<?php

namespace Romanlazko\LaravelTelegram\Models\Types\VideoChat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class VideoChatScheduled extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'start_date' => 'datetime',
        ];
    }
}
