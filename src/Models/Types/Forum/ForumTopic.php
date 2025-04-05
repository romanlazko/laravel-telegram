<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Forum;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker\Sticker;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class ForumTopic extends BaseType implements ShouldBeSaved
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'message_thread_id' => 'integer',
            'name' => 'string',
            'icon_color' => 'integer',
            'icon_custom_emoji_id' => Type::using(Sticker::class),
        ];
    }
}
