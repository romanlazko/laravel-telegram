<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class WriteAccessAllowed extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'from_request' => 'boolean',
            'web_app_name' => 'string',
            'from_attachment_menu' => 'boolean',
        ];
    }
}
