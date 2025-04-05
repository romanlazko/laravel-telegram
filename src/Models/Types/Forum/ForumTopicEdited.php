<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Forum;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ForumTopicEdited extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'name' => 'string',
            'icon_custom_emoji_id' => 'string',
        ];
    }
}
