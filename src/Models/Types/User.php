<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeUnique;

class User extends BaseType implements ShouldBeSaved, ShouldBeUnique
{
    protected $table = 'telegram_users';

    protected $primaryKey = 'telegram_user_id';

    protected $uniqueKey = 'id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'integer',
            'is_bot' => 'boolean',
            'first_name' => 'string',
            'last_name' => 'string',
            'username' => 'string',
            'language_code' => 'string',
            'is_premium' => 'boolean',
            'added_to_attachment_menu' => 'boolean',
            'can_join_groups' => 'boolean',
            'can_read_all_group_messages' => 'boolean',
            'supports_inline_queries' => 'boolean',
            'can_connect_to_business' => 'boolean',
            'has_main_web_app' => 'boolean',
        ];
    }
}
