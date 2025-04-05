<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Chat;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Birthdate extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'day' => 'integer',
            'month' => 'integer',
            'year' => 'integer',
        ];
    }
}
