<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ChatBoostSourcePremium extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'source' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
