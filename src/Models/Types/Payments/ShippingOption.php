<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class ShippingOption extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'string',
            'title' => 'string',
            'prices' => CollectionOfType::using(LabeledPrice::class),
        ];
    }
}
