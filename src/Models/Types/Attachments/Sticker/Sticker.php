<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\File;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class Sticker extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'file_id' => 'string',
            'file_unique_id' => 'string',
            'type' => 'string',
            'width' => 'integer',
            'height' => 'integer',
            'is_animated' => 'boolean',
            'is_video' => 'boolean',
            'thumbnail' => Type::using(PhotoSize::class),
            'emoji' => 'string',
            'set_name' => 'string',
            'premium_animation' => Type::using(File::class),
            'mask_position' => Type::using(MaskPosition::class),
            'custom_emoji_id' => 'string',
            'needs_reupload' => 'boolean',
            'file_size' => 'integer',
        ];
    }
}
