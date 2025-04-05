<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeUnique;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageEntity;

class Poll extends BaseType implements ShouldBeSaved, ShouldBeUnique
{
    protected $table = 'telegram_polls';

    protected $primaryKey = 'telegram_poll_id';

    protected $uniqueKey = 'id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'integer',
            'question' => 'string',
            'question_entities' => CollectionOfType::using(MessageEntity::class),
            'options' => CollectionOfType::using(PollOption::class),
            'total_voter_count' => 'integer',
            'is_closed' => 'boolean',
            'is_anonymous' => 'boolean',
            'type' => 'string',
            'allows_multiple_answers' => 'boolean',
            'correct_option_id' => 'integer',
            'explanation' => 'string',
            'explanation_entities' => CollectionOfType::using(MessageEntity::class),
            'open_period' => 'integer',
            'close_date' => 'integer',
        ];
    }
}
