<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatMember;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ChatMemberRestricted extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'status' => 'string',
            'can_send_messages' => 'boolean',
            'can_send_audios' => 'boolean',
            'can_send_documents' => 'boolean',
            'can_send_photos' => 'boolean',
            'can_send_videos' => 'boolean',
            'can_send_video_notes' => 'boolean',
            'can_send_voice_notes' => 'boolean',
            'can_send_polls' => 'boolean',
            'can_send_other_messages' => 'boolean',
            'can_add_web_page_previews' => 'boolean',
            'can_change_info' => 'boolean',
            'can_invite_users' => 'boolean',
            'can_pin_messages' => 'boolean',
            'can_manage_topics' => 'boolean',
            'until_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
