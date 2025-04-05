<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Business;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\User;

class BusinessConnection extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_business_connections';

    protected $primaryKey = 'telegram_business_connection_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'integer',
            'user_chat_id' => 'integer',
            'date' => 'datetime',
            'can_reply' => 'boolean',
            'is_enabled' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
