<?php

namespace Romanlazko\LaravelTelegram\Models\Types\PaidMedia;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Video;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class PaidMediaVideo extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'video' => Type::using(Video::class),
        ];
    }
}
