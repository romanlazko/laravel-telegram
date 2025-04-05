<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class Gift extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'string',
            'sticker' => Type::using(Sticker::class),
            'star_count' => 'integer',
            'upgrade_star_count' => 'integer',
            'total_count' => 'integer',
            'remaining_count' => 'integer',
        ];
    }
}
