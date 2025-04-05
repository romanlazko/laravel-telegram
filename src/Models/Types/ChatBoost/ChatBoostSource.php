<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBoost;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ChatBoostSource extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): ChatBoostSourcePremium|ChatBoostSourceGiftCode|ChatBoostSourceGiveaway
    {
        $types = [
            'premium' => ChatBoostSourcePremium::class,
            'gift_code' => ChatBoostSourceGiftCode::class,
            'giveaway' => ChatBoostSourceGiveaway::class,
        ];

        return $types[$data['source']]::fromRequest($data, $attributes);
    }
}
