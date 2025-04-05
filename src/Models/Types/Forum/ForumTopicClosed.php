<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Forum;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ForumTopicClosed extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
        ];
    }
}
