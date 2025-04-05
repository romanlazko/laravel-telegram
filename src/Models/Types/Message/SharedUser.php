<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class SharedUser extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'user_id' => 'integer',
            'first_name' => 'string',
            'last_name' => 'string',
            'username' => 'string',
            'photo' => CollectionOfType::using(PhotoSize::class),
        ];
    }
}
