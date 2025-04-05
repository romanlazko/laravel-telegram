<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Location;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class InlineQuery extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_inline_queries';

    protected $primaryKey = 'telegram_inline_query_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'string',
            'query' => 'string',
            'offset' => 'string',
            'chat_type' => 'string',
            'location' => Type::using(Location::class),
        ];
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
