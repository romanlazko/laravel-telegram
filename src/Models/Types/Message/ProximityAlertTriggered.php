<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ProximityAlertTriggered extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'distance' => 'integer',
        ];
    }

    public function traveler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'traveler_id');
    }

    public function watcher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'watcher_id');
    }
}
