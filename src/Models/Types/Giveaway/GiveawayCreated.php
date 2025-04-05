<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Giveaway;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class GiveawayCreated extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'prize_star_count' => 'integer',
        ];
    }
}
