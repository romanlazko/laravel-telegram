<?php

namespace Romanlazko\LaravelTelegram\Models\Types\VideoChat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class VideoChatStarted extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
        ];
    }
}
