<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Business;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BusinessOpeningHoursInterval extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'opening_minute' => 'integer',
            'closing_minute' => 'integer',
        ];
    }
}
