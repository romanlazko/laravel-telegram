<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class RefundedPayment extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'currency' => 'string',
            'total_amount' => 'int',
            'invoice_payload' => 'string',
            'telegram_payment_charge_id' => 'string',
            'provider_payment_charge_id' => 'string',
        ];
    }
}
