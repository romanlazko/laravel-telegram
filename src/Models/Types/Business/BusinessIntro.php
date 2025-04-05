<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Business;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker\Sticker;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class BusinessIntro extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'title' => 'string',
            'message' => 'string',
            'sticker' => Type::using(Sticker::class),
        ];
    }
}
