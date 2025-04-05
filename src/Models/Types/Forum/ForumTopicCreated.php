<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Forum;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ForumTopicCreated extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'name' => 'string',
            'icon_color' => 'integer',
            'icon_custom_emoji_id' => 'string',
        ];
    }
}
