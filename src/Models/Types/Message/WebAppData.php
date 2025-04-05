<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class WebAppData extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'data' => 'string',
            'button_text' => 'string',
        ];
    }
}
