<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageEntity;

class PollOption extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'text' => 'string',
            'text_entities' => CollectionOfType::using(MessageEntity::class),
            'voter_count' => 'integer',
        ];
    }
}
