<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message\MessageOrigin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;

class MessageOriginChat extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'date' => 'datetime',
            'author_signature' => 'string',
        ];
    }

    public function sender_chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_sender_chat_id');
    }
}
