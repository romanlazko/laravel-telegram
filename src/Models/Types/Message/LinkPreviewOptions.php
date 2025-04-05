<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class LinkPreviewOptions extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'is_disabled' => 'boolean',
            'url' => 'string',
            'prefer_small_media' => 'boolean',
            'prefer_large_media' => 'boolean',
            'show_above_text' => 'boolean',
        ];
    }
}
