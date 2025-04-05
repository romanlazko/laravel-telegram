<?php

namespace Romanlazko\LaravelTelegram\Models\Types\PaidMedia;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class PaidMediaInfo extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'star_count' => 'integer',
            'paid_media' => CollectionOfType::using(PaidMedia::class),
        ];
    }
}
