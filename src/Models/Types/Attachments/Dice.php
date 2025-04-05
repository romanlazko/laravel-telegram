<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Dice extends BaseType
{
    public function casts(): array
    {
        return [
            'emoji' => 'string',
            'value' => 'int',
        ];
    }
}
