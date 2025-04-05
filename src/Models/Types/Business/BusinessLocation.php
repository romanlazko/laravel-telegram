<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Business;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Location;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class BusinessLocation extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'address' => 'string',
            'location' => Type::using(Location::class),
        ];
    }
}
