<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Invoice extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'title' => 'string',
            'description' => 'string',
            'start_parameter' => 'string',
            'currency' => 'string',
            'total_amount' => 'integer',
        ];
    }
}
