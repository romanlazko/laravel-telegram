<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Romanlazko\LaravelTelegram\Models\Conversation;
use Romanlazko\LaravelTelegram\Models\Types\Business\BusinessIntro;
use Romanlazko\LaravelTelegram\Models\Types\Business\BusinessLocation;
use Romanlazko\LaravelTelegram\Models\Types\Business\BusinessOpeningHours;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Chat\Birthdate;
use Romanlazko\LaravelTelegram\Models\Types\Chat\ChatLocation;
use Romanlazko\LaravelTelegram\Models\Types\Chat\ChatPermissions;
use Romanlazko\LaravelTelegram\Models\Types\Chat\ChatPhoto;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeUnique;
use Romanlazko\LaravelTelegram\Models\Types\ReactionType\ReactionType;

class Chat extends BaseType implements ShouldBeSaved, ShouldBeUnique
{
    use Notifiable;

    protected $table = 'telegram_chats';

    protected $primaryKey = 'telegram_chat_id';

    protected $uniqueKey = 'id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'id' => 'integer',
            'type' => 'string',
            'title' => 'string',
            'username' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'is_forum' => 'boolean',
            'accent_color_id' => 'integer',
            'max_reaction_count' => 'integer',
            'photo' => Type::using(ChatPhoto::class),
            'active_usernames' => 'array',
            'birthdate' => Type::using(Birthdate::class),
            'business_intro' => Type::using(BusinessIntro::class),
            'business_location' => Type::using(BusinessLocation::class),
            'business_opening_hours' => Type::using(BusinessOpeningHours::class),
            'available_reactions' => CollectionOfType::using(ReactionType::class),
            'background_custom_emoji_id' => 'integer',
            'profile_accent_color_id' => 'integer',
            'profile_background_custom_emoji_id' => 'integer',
            'emoji_status_custom_emoji_id' => 'integer',
            'emoji_status_expiration_date' => 'integer',
            'bio' => 'string',
            'has_private_forwards' => 'boolean',
            'has_restricted_voice_and_video_messages' => 'boolean',
            'join_to_send_messages' => 'boolean',
            'join_by_request' => 'boolean',
            'description' => 'string',
            'invite_link' => 'string',
            'permissions' => Type::using(ChatPermissions::class),
            'can_send_gift' => 'boolean',
            'can_send_paid_media' => 'boolean',
            'slow_mode_delay' => 'integer',
            'unrestrict_boost_count' => 'integer',
            'message_auto_delete_time' => 'integer',
            'has_aggressive_anti_spam_enabled' => 'boolean',
            'has_hidden_members' => 'boolean',
            'has_protected_content' => 'boolean',
            'has_visible_history' => 'boolean',
            'sticker_set_name' => 'string',
            'can_set_sticker_set' => 'boolean',
            'custom_emoji_sticker_set_name' => 'string',
            'linked_chat_id' => 'integer',
            'location' => Type::using(ChatLocation::class),
        ];
    }

    protected static function booted(): void
    {
        static::created(function (Chat $chat) {
            $chat->conversation()->create();
        });
    }

    // BelongsTo

    public function personal_chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_personal_chat_id');
    }

    public function pinned_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_pinned_message_id');
    }

    // HasMany

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'telegram_chat_id');
    }

    // HasOne

    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class, 'telegram_chat_id')->latestOfMany('telegram_message_id');
    }

    public function conversation(): HasOne
    {
        return $this->hasOne(Conversation::class, 'telegram_chat_id');
    }

    // Attributes

    public function can($permission): bool
    {
        return data_get($this->permissions, $permission, false);
    }
}
