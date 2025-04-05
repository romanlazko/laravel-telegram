<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatMember;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\User;

class ChatInviteLink extends BaseType
{
    protected array $fields = [
        'invite_link' => true,
        'creator' => User::class,
        'creates_join_request' => true,
        'is_primary' => true,
        'is_revoked' => true,
        'name' => true,
        'expire_date' => true,
        'member_limit' => true,
        'pending_join_request_count' => true,
        'subscription_period' => true,
        'subscription_price' => true,
    ];
}
