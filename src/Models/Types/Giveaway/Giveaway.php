<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Giveaway;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;

class Giveaway extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'chats' => CollectionOfType::using(Chat::class),
            'winners_selection_date' => 'datetime',
            'winner_count' => 'integer',
            'only_new_members' => 'boolean',
            'has_public_winners' => 'boolean',
            'prize_description' => 'string',
            'country_codes' => 'array',
            'prize_star_count' => 'integer',
            'premium_subscription_month_count' => 'integer',
        ];
    }
}
