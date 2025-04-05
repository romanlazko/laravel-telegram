<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class ChatBoostRemoved extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_chat_boost_removed';

    protected $primaryKey = 'telegram_chat_boost_removed_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'boost_id' => 'string',
            'remove_date' => 'datetime',
            'source' => Type::using(ChatBoostSource::class),
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }
}
