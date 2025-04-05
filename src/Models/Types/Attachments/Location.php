<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Location extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'longitude' => 'float',
            'latitude' => 'float',
            'horizontal_accuracy' => 'float',
            'live_period' => 'int',
            'heading' => 'int',
            'proximity_alert_radius' => 'int',
        ];
    }
}
