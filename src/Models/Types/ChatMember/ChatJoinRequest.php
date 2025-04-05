<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatMember;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ChatJoinRequest extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_chat_join_requests';

    protected $primaryKey = 'telegram_chat_join_request_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'user_chat_id' => 'integer',
            'date' => 'datetime',
            'bio' => 'string',
            'invite_link' => Type::using(ChatInviteLink::class),
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
