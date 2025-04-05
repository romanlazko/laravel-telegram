<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Chat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ChatPhoto extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'small_file_id' => 'string',
            'small_file_unique_id' => 'string',
            'big_file_id' => 'string',
            'big_file_unique_id' => 'string',
        ];
    }
}
