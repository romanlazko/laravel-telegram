<?php

namespace Romanlazko\LaravelTelegram\Models\Types\VideoChat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class VideoChatEnded extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'duration' => 'integer',
        ];
    }
}
