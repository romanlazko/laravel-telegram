<?php

namespace Romanlazko\LaravelTelegram\Models\Types\MenuButton;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MenuButtonCommands extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
        ];
    }
}
