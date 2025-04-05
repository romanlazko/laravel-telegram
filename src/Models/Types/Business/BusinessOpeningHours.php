<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Business;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class BusinessOpeningHours extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'time_zone_name' => 'string',
            'opening_hours' => CollectionOfType::using(BusinessOpeningHoursInterval::class),
        ];
    }
}
