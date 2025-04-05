<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class MessageEntity extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'offset' => 'integer',
            'length' => 'integer',
            'url' => 'string',
            'language' => 'string',
            'custom_emoji_id' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
