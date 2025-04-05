<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ReactionType;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class ReactionCount extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => Type::using(ReactionType::class),
            'total_count' => 'integer',
        ];
    }
}
