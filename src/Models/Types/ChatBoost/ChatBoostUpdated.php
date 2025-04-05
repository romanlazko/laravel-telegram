<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class ChatBoostUpdated extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_chat_boost_updated';

    protected $primaryKey = 'telegram_chat_boost_updated_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'boost' => Type::using(ChatBoost::class),
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }
}
