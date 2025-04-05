<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfCollectionOfType;

class UserProfilePhotos extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'total_count' => 'integer',
            'photos' => CollectionOfCollectionOfType::using(PhotoSize::class),
        ];
    }
}
