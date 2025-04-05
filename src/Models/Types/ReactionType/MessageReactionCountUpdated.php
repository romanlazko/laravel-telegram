<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ReactionType;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class MessageReactionCountUpdated extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_message_reaction_count_updated';

    protected $primaryKey = 'telegram_message_reaction_count_updated_id';

    protected function casts(): array
    {
        return [
            'telegram_chat_id' => 'integer',
            'message_id' => 'integer',
            'date' => 'datetime',
            'reactions' => CollectionOfType::using(ReactionCount::class),
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }
}
