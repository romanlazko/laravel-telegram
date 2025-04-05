<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Passport;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class PassportData extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'data' => CollectionOfType::using(EncryptedPassportElement::class),
            'credentials' => Type::using(EncryptedCredentials::class),
        ];
    }
}
