<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Passport;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class EncryptedPassportElement extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'type' => 'string',
            'data' => 'string',
            'phone_number' => 'string',
            'email' => 'string',
            'files' => CollectionOfType::using(PassportFile::class),
            'front_side' => Type::using(PassportFile::class),
            'reverse_side' => Type::using(PassportFile::class),
            'selfie' => Type::using(PassportFile::class),
            'translation' => CollectionOfType::using(PassportFile::class),
            'hash' => 'string',
        ];
    }
}
