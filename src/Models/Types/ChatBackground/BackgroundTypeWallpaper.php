<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Document;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class BackgroundTypeWallpaper extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'document' => Type::using(Document::class),
            'dark_theme_dimming' => 'integer',
            'is_blurred' => 'boolean',
            'is_moving' => 'boolean',
        ];
    }
}
