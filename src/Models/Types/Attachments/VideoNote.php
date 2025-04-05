<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class VideoNote extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'file_id' => 'string',
            'file_unique_id' => 'string',
            'length' => 'integer',
            'duration' => 'integer',
            'thumbnail' => Type::using(PhotoSize::class),
            'file_size' => 'integer',
        ];
    }
}
