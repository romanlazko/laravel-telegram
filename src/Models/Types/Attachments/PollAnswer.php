<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class PollAnswer extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_poll_answers';

    protected $primaryKey = 'telegram_poll_answer_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'poll_id' => 'integer',
            'option_ids' => 'array',
        ];
    }

    // BelongsTo

    public function voter_chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
