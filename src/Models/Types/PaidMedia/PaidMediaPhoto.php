<?php

namespace Romanlazko\LaravelTelegram\Models\Types\PaidMedia;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class PaidMediaPhoto extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'photo' => CollectionOfType::using(PhotoSize::class),
        ];
    }
}
