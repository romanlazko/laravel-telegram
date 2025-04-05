<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message\MessageOrigin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class MessageOriginUser extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'date' => 'datetime',
        ];
    }

    public function sender_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_sender_user_id');
    }
}
