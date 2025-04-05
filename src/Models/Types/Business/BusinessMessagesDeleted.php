<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Business;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class BusinessMessagesDeleted extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_business_messages_deleted';

    protected $primaryKey = 'telegram_business_messages_deleted_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'business_connection_id' => 'integer',
            'message_ids' => 'array',
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }
}
