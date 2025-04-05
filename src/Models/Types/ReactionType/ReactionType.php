<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ReactionType;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ReactionType extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): ReactionTypeEmoji|ReactionTypeCustomEmoji|ReactionTypePaid
    {
        $types = [
            'emoji' => ReactionTypeEmoji::class,
            'custom_emoji_id' => ReactionTypeCustomEmoji::class,
            'paid' => ReactionTypePaid::class,
        ];

        return $types[$data['type']]::fromRequest($data, $attributes);
    }
}
