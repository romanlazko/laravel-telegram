<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageEntity;

class Game extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'title' => 'string',
            'description' => 'string',
            'photo' => CollectionOfType::using(PhotoSize::class),
            'text' => 'string',
            'text_entities' => CollectionOfType::using(MessageEntity::class),
            'animation' => Type::using(Animation::class),
        ];
    }
}
