<?php

namespace Romanlazko\LaravelTelegram\Models\Types\PaidMedia;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class PaidMediaPurchased extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_paid_media_purchased';

    protected $primaryKey = 'telegram_paid_media_purchased_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'paid_media_payload' => 'string',
        ];
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
