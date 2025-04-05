<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Giveaway;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Message;

class GiveawayCompleted extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'winner_count' => 'integer',
            'unclaimed_prize_count' => 'integer',
            'is_star_giveaway' => 'boolean',
        ];
    }

    public function giveaway_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_message_id');
    }
}
