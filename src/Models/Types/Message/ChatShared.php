<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class ChatShared extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'request_id' => 'string',
            'chat_id' => 'integer',
            'title' => 'string',
            'username' => 'string',
            'photo' => CollectionOfType::using(PhotoSize::class),
        ];
    }
}
