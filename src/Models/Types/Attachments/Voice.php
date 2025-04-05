<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Voice extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'file_id' => 'string',
            'file_unique_id' => 'string',
            'duration' => 'integer',
            'mime_type' => 'string',
            'file_size' => 'integer',
        ];
    }
}
