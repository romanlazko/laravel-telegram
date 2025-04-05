<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Forum;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ForumTopicReopened extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
        ];
    }
}
