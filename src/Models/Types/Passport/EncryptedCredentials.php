<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Passport;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class EncryptedCredentials extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'data' => 'string',
            'hash' => 'string',
            'secret' => 'string',
        ];
    }
}
