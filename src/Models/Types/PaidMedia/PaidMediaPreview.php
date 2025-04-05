<?php

namespace Romanlazko\LaravelTelegram\Models\Types\PaidMedia;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class PaidMediaPreview extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'width' => 'integer',
            'height' => 'integer',
            'duration' => 'integer',
        ];
    }
}
