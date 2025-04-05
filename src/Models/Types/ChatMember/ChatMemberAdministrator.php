<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatMember;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ChatMemberAdministrator extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'status' => 'string',
            'can_be_edited' => 'boolean',
            'is_anonymous' => 'boolean',
            'can_manage_chat' => 'boolean',
            'can_delete_messages' => 'boolean',
            'can_manage_video_chats' => 'boolean',
            'can_restrict_members' => 'boolean',
            'can_promote_members' => 'boolean',
            'can_change_info' => 'boolean',
            'can_invite_users' => 'boolean',
            'can_post_stories' => 'boolean',
            'can_edit_stories' => 'boolean',
            'can_delete_stories' => 'boolean',
            'can_post_messages' => 'boolean',
            'can_edit_messages' => 'boolean',
            'can_pin_messages' => 'boolean',
            'can_manage_topics' => 'boolean',
            'custom_title' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
