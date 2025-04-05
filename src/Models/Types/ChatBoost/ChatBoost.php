<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ChatBoost extends BaseType
{
    protected array $fields = [
        'boost_id' => true,
        'add_date' => true,
        'expiration_date' => true,
        'source' => ChatBoostSource::class,
    ];
}
