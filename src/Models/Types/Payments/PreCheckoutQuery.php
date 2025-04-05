<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class PreCheckoutQuery extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_pre_checkout_queries';

    protected $primaryKey = 'telegram_pre_checkout_query_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'string',
            'currency' => 'string',
            'total_amount' => 'integer',
            'invoice_payload' => 'string',
            'shipping_option_id' => 'string',
            'order_info' => Type::using(OrderInfo::class),
        ];
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
