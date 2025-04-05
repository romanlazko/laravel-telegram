<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Contact extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'phone_number' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'user_id' => 'int',
            'vcard' => 'string',
        ];
    }
}
