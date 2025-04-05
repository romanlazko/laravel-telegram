<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatMember;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class ChatMember extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
    {
        $types = [
            'creator' => ChatMemberOwner::class,
            'administrator' => ChatMemberAdministrator::class,
            'member' => ChatMemberMember::class,
            'restricted' => ChatMemberRestricted::class,
            'left' => ChatMemberLeft::class,
            'kicked' => ChatMemberBanned::class,
        ];

        return $types[$data['status']]::fromRequest($data, $attributes);
    }
}
