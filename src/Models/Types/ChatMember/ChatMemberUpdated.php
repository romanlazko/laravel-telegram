<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatMember;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ChatMemberUpdated extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_chat_member_updated';

    protected $primaryKey = 'telegram_chat_member_updated_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'date' => 'datetime',
            'old_chat_member' => Type::using(ChatMember::class),
            'new_chat_member' => Type::using(ChatMember::class),
            'invite_link' => Type::using(ChatInviteLink::class),
            'via_join_request' => 'boolean',
            'via_chat_folder_invite_link' => 'boolean',
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
