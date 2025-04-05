<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class Gifts extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'gifts' => CollectionOfType::using(Gift::class),
        ];
    }
}
