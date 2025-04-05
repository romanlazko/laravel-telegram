<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ReactionType;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class MessageReactionUpdated extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_message_reaction_updated';

    protected $primaryKey = 'telegram_message_reaction_updated_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'message_id' => 'integer',
            'date' => 'datetime',
            'old_reaction' => CollectionOfType::using(ReactionType::class),
            'new_reaction' => CollectionOfType::using(ReactionType::class),
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }

    public function actor_chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_actor_chat_id');
    }
}
