<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class File extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'file_id' => 'string',
            'file_unique_id' => 'string',
            'file_size' => 'integer',
            'file_path' => 'string',
        ];
    }
}
