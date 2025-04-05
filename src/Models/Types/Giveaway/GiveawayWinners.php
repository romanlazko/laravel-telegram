<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Giveaway;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\User;

class GiveawayWinners extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'giveaway_message_id' => 'integer',
            'winners_selection_date' => 'datetime',
            'winner_count' => 'integer',
            'winners' => CollectionOfType::using(User::class),
            'additional_chat_count' => 'integer',
            'prize_star_count' => 'integer',
            'premium_subscription_month_count' => 'integer',
            'unclaimed_prize_count' => 'integer',
            'only_new_members' => 'boolean',
            'was_refunded' => 'boolean',
            'prize_description' => 'string',
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }
}
