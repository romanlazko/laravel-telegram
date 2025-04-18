<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Chat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ChatPermissions extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
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
        ];
    }
}
