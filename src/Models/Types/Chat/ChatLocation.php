<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Chat;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Location;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class ChatLocation extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'location' => Type::using(Location::class),
            'address' => 'string',
        ];
    }
}
