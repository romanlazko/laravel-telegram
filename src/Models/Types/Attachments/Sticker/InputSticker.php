<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class InputSticker extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'sticker' => 'string',
            'format' => 'string',
            'emoji_list' => 'array',
            'mask_position' => Type::using(MaskPosition::class),
            'keywords' => 'array',
        ];
    }
}
