<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Document;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class BackgroundTypePattern extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'document' => Type::using(Document::class),
            'pattern' => Type::using(BackgroundFill::class),
            'intensity' => 'integer',
            'is_inverted' => 'boolean',
            'is_moving' => 'boolean',
        ];
    }
}
