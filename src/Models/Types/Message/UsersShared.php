<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;

class UsersShared extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'request_id' => 'integer',
            'users' => CollectionOfType::using(SharedUser::class),
        ];
    }
}
