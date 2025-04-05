<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeUnique;

class CallbackQuery extends BaseType implements ShouldBeSaved, ShouldBeUnique
{
    protected $table = 'telegram_callback_queries';

    protected $primaryKey = 'telegram_callback_query_id';

    protected $uniqueKey = 'id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'string',
            'inline_message_id' => 'string',
            'chat_instance' => 'string',
            'data' => 'string',
            'game_short_name' => 'string',
        ];
    }

    // BelongsTo

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_message_id');
    }

    // Attributes

    public function getCommandAttribute(): string
    {
        [$command, $params] = explode('?', $this->data);

        return $command;
    }

    public function getInlineDataAttribute(): array
    {
        [$command, $params] = explode('?', $this->data);

        $params = explode('|', $params);

        foreach ($params as $key => $param) {
            if (strpos($param, ':') !== false) {
                $params[$key] = explode(':', $param);
            }
        }

        return $params;
    }
}
