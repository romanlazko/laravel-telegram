<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class Video extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'file_id' => 'string',
            'file_unique_id' => 'string',
            'width' => 'integer',
            'height' => 'integer',
            'duration' => 'integer',
            'thumbnail' => Type::using(PhotoSize::class),
            'cover' => CollectionOfType::using(PhotoSize::class),
            'start_timestamp' => 'integer',
            'file_name' => 'string',
            'mime_type' => 'string',
            'file_size' => 'integer',
        ];
    }
}
