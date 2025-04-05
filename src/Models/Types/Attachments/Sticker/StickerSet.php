<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class StickerSet extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'name' => 'string',
            'title' => 'string',
            'sticker_type' => 'string',
            'stickers' => CollectionOfType::using(Sticker::class),
            'thumbnail' => Type::using(PhotoSize::class),
        ];
    }
}
