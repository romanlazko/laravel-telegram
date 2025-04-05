<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class OrderInfo extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'name' => 'string',
            'phone_number' => 'string',
            'email' => 'string',
            'shipping_address' => Type::using(ShippingAddress::class),
        ];
    }
}
