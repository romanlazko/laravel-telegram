<?php

namespace Romanlazko\LaravelTelegram\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Update;

class TelegramBot extends BaseType
{
    protected $table = 'telegram_bots';

    protected $primaryKey = 'telegram_bot_id';

    protected $fillable = [
        'telegram_bot_id',
        'token',
        'name',
        'first_name',
        'last_name',
        'username',
        'can_join_groups',
        'can_read_all_group_messages',
        'supports_inline_queries',
        'can_connect_to_business',
        'has_main_web_app',
    ];

    protected $casts = [
        'telegram_bot_id' => 'integer',
        'token' => 'string',
        'name' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'username' => 'string',
        'can_join_groups' => 'boolean',
        'can_read_all_group_messages' => 'boolean',
        'supports_inline_queries' => 'boolean',
        'can_connect_to_business' => 'boolean',
        'has_main_web_app' => 'boolean',
    ];

    public function updates(): HasMany
    {
        return $this->hasMany(Update::class, 'telegram_bot_id');
    }

    public function latestUpdate(): HasOne
    {
        return $this->hasOne(Update::class, 'telegram_bot_id')->latestOfMany('update_id');
    }
}
