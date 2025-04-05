<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;

class SuccessfulPayment extends BaseType
{
    public function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'currency' => 'string',
            'total_amount' => 'integer',
            'invoice_payload' => 'string',
            'subscription_expiration_date' => 'integer',
            'is_recurring' => 'boolean',
            'is_first_recurring' => 'boolean',
            'shipping_option_id' => 'string',
            'order_info' => Type::using(OrderInfo::class),
            'telegram_payment_charge_id' => 'string',
            'provider_payment_charge_id' => 'string',
        ];
    }
}
