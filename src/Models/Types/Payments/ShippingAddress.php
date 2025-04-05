<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ShippingAddress extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'country_code' => 'string',
            'state' => 'string',
            'city' => 'string',
            'street_line1' => 'string',
            'street_line2' => 'string',
            'post_code' => 'string',
        ];
    }
}
