<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message\MessageOrigin;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MessageOrigin extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): MessageOriginUser|MessageOriginHiddenUser|MessageOriginChat|MessageOriginChannel
    {
        $types = [
            'user' => MessageOriginUser::class,
            'hidden_user' => MessageOriginHiddenUser::class,
            'chat' => MessageOriginChat::class,
            'channel' => MessageOriginChannel::class,
        ];

        return $types[$data['type']]::fromRequest($data, $attributes);
    }
}
