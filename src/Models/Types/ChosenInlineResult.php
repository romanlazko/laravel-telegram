<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Location;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;

class ChosenInlineResult extends BaseType implements ShouldBeSaved
{
    protected $table = 'telegram_chosen_inline_results';

    protected $primaryKey = 'telegram_chosen_inline_result_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'result_id' => 'string',
            'location' => Type::using(Location::class),
            'inline_message_id' => 'string',
            'query' => 'string',
        ];
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }
}
