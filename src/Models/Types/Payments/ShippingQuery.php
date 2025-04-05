<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Payments;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ShippingQuery extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_shipping_queries';

    protected $primaryKey = 'telegram_shipping_query_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'string',
            'invoice_payload' => 'string',
            'shipping_address' => Type::using(ShippingAddress::class),
        ];
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
