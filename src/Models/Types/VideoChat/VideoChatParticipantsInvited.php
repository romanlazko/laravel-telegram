<?php

namespace Romanlazko\LaravelTelegram\Models\Types\VideoChat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class VideoChatParticipantsInvited extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'users' => CollectionOfType::using(User::class),
        ];
    }
}
