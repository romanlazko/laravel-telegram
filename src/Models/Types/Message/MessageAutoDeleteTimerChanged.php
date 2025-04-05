<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MessageAutoDeleteTimerChanged extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'message_auto_delete_timer_changed' => 'integer',
        ];
    }
}
