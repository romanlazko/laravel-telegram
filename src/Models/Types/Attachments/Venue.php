<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class Venue extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'location' => Type::using(Location::class),
            'title' => 'string',
            'address' => 'string',
            'foursquare_id' => 'string',
            'foursquare_type' => 'string',
            'google_place_id' => 'string',
            'google_place_type' => 'string',
        ];
    }
}
