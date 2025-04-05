<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class Audio extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'file_id' => 'string',
            'file_unique_id' => 'string',
            'duration' => 'integer',
            'performer' => 'string',
            'title' => 'string',
            'file_name' => 'string',
            'mime_type' => 'string',
            'file_size' => 'integer',
            'thumbnail' => Type::using(PhotoSize::class),
        ];
    }
}
