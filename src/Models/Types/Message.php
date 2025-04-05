<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Animation;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Audio;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Contact;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Dice;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Document;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Game;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Location;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\PhotoSize;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Poll;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker\Sticker;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Story;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Venue;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Video;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\VideoNote;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Voice;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\ChatBackground\ChatBackground;
use Romanlazko\LaravelTelegram\Models\Types\ChatBoost\ChatBoostAdded;
use Romanlazko\LaravelTelegram\Models\Types\Concerns\HasAvailableTypes;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeUnique;
use Romanlazko\LaravelTelegram\Models\Types\Forum\ForumTopicClosed;
use Romanlazko\LaravelTelegram\Models\Types\Forum\ForumTopicCreated;
use Romanlazko\LaravelTelegram\Models\Types\Forum\ForumTopicEdited;
use Romanlazko\LaravelTelegram\Models\Types\Forum\ForumTopicReopened;
use Romanlazko\LaravelTelegram\Models\Types\Forum\GeneralForumTopicHidden;
use Romanlazko\LaravelTelegram\Models\Types\Forum\GeneralForumTopicUnhidden;
use Romanlazko\LaravelTelegram\Models\Types\Giveaway\Giveaway;
use Romanlazko\LaravelTelegram\Models\Types\Giveaway\GiveawayCompleted;
use Romanlazko\LaravelTelegram\Models\Types\Giveaway\GiveawayCreated;
use Romanlazko\LaravelTelegram\Models\Types\Giveaway\GiveawayWinners;
use Romanlazko\LaravelTelegram\Models\Types\Message\ChatShared;
use Romanlazko\LaravelTelegram\Models\Types\Message\ExternalReplyInfo;
use Romanlazko\LaravelTelegram\Models\Types\Message\LinkPreviewOptions;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageAutoDeleteTimerChanged;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageEntity;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageOrigin\MessageOrigin;
use Romanlazko\LaravelTelegram\Models\Types\Message\ProximityAlertTriggered;
use Romanlazko\LaravelTelegram\Models\Types\Message\TextQuote;
use Romanlazko\LaravelTelegram\Models\Types\Message\UsersShared;
use Romanlazko\LaravelTelegram\Models\Types\Message\WebAppData;
use Romanlazko\LaravelTelegram\Models\Types\Message\WriteAccessAllowed;
use Romanlazko\LaravelTelegram\Models\Types\PaidMedia\PaidMediaInfo;
use Romanlazko\LaravelTelegram\Models\Types\Passport\PassportData;
use Romanlazko\LaravelTelegram\Models\Types\Payments\Invoice;
use Romanlazko\LaravelTelegram\Models\Types\Payments\RefundedPayment;
use Romanlazko\LaravelTelegram\Models\Types\Payments\SuccessfulPayment;
use Romanlazko\LaravelTelegram\Models\Types\VideoChat\VideoChatEnded;
use Romanlazko\LaravelTelegram\Models\Types\VideoChat\VideoChatParticipantsInvited;
use Romanlazko\LaravelTelegram\Models\Types\VideoChat\VideoChatScheduled;
use Romanlazko\LaravelTelegram\Models\Types\VideoChat\VideoChatStarted;

class Message extends BaseType implements ShouldBeSaved, ShouldBeUnique
{
    use HasAvailableTypes;

    protected $table = 'telegram_messages';

    protected $primaryKey = 'telegram_message_id';

    protected $uniqueKey = 'message_id';

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'message_id' => 'integer',
            'message_thread_id' => 'integer',
            'sender_boost_count' => 'integer',
            'date' => 'datetime',
            'business_connection_id' => 'integer',
            'forward_origin' => Type::using(MessageOrigin::class),
            'is_topic_message' => 'boolean',
            'is_automatic_forward' => 'boolean',
            'external_reply' => Type::using(ExternalReplyInfo::class),
            'quote' => Type::using(TextQuote::class),
            'reply_to_story' => Type::using(Story::class),
            'edit_date' => 'datetime',
            'has_protected_content' => 'boolean',
            'is_from_offline' => 'boolean',
            'media_group_id' => 'string',
            'author_signature' => 'string',
            'text' => 'string',
            'entities' => CollectionOfType::using(MessageEntity::class),
            'link_preview_options' => Type::using(LinkPreviewOptions::class),
            'effect_id' => 'integer',
            'animation' => Type::using(Animation::class),
            'audio' => Type::using(Audio::class),
            'document' => Type::using(Document::class),
            'paid_media' => Type::using(PaidMediaInfo::class),
            'photo' => CollectionOfType::using(PhotoSize::class),
            'sticker' => Type::using(Sticker::class),
            'story' => Type::using(Story::class),
            'video' => Type::using(Video::class),
            'video_note' => Type::using(VideoNote::class),
            'voice' => Type::using(Voice::class),
            'caption' => 'string',
            'caption_entities' => CollectionOfType::using(MessageEntity::class),
            'show_caption_above_media' => 'boolean',
            'has_media_spoiler' => 'boolean',
            'contact' => Type::using(Contact::class),
            'dice' => Type::using(Dice::class),
            'game' => Type::using(Game::class),
            'venue' => Type::using(Venue::class),
            'location' => Type::using(Location::class),
            'new_chat_members' => CollectionOfType::using(User::class),
            'new_chat_title' => 'string',
            'new_chat_photo' => CollectionOfType::using(PhotoSize::class),
            'delete_chat_photo' => 'boolean',
            'group_chat_created' => 'boolean',
            'supergroup_chat_created' => 'boolean',
            'channel_chat_created' => 'boolean',
            'message_auto_delete_timer_changed' => Type::using(MessageAutoDeleteTimerChanged::class),
            'migrate_to_chat_id' => 'integer',
            'migrate_from_chat_id' => 'integer',
            'invoice' => Type::using(Invoice::class),
            'successful_payment' => Type::using(SuccessfulPayment::class),
            'refunded_payment' => Type::using(RefundedPayment::class),
            'users_shared' => Type::using(UsersShared::class),
            'chat_shared' => Type::using(ChatShared::class),
            'connected_website' => 'string',
            'write_access_allowed' => Type::using(WriteAccessAllowed::class),
            'passport_data' => Type::using(PassportData::class),
            'proximity_alert_triggered' => Type::using(ProximityAlertTriggered::class),
            'boost_added' => Type::using(ChatBoostAdded::class),
            'chat_background_set' => Type::using(ChatBackground::class),
            'forum_topic_created' => Type::using(ForumTopicCreated::class),
            'forum_topic_edited' => Type::using(ForumTopicEdited::class),
            'forum_topic_closed' => Type::using(ForumTopicClosed::class),
            'forum_topic_reopened' => Type::using(ForumTopicReopened::class),
            'general_forum_topic_hidden' => Type::using(GeneralForumTopicHidden::class),
            'general_forum_topic_unhidden' => Type::using(GeneralForumTopicUnhidden::class),
            'giveaway_created' => Type::using(GiveawayCreated::class),
            'giveaway' => Type::using(Giveaway::class),
            'giveaway_winners' => Type::using(GiveawayWinners::class),
            'giveaway_completed' => Type::using(GiveawayCompleted::class),
            'video_chat_scheduled' => Type::using(VideoChatScheduled::class),
            'video_chat_started' => Type::using(VideoChatStarted::class),
            'video_chat_ended' => Type::using(VideoChatEnded::class),
            'video_chat_participants_invited' => Type::using(VideoChatParticipantsInvited::class),
            'web_app_data' => Type::using(WebAppData::class),
            'reply_markup' => 'array',
        ];
    }

    protected $availableTypes = [
        'text',
        'animation',
        'audio',
        'document',
        'photo',
        'sticker',
        'video',
        'video_note',
        'voice',
        'contact',
        'dice',
        'game',
        'poll',
        'venue',
        'location',
        'new_chat_members',
        'left_chat_member',
        'new_chat_title',
        'new_chat_photo',
        'delete_chat_photo',
        'group_chat_created',
        'supergroup_chat_created',
        'channel_chat_created',
        'message_auto_delete_timer_changed',
        'migrate_to_chat_id',
        'migrate_from_chat_id',
        'pinned_message',
        'invoice',
        'successful_payment',
        'users_shared',
        'chat_shared',
        'write_access_allowed',
        'passport_data',
        'proximity_alert_triggered',
        'boost_added',
        'forum_topic_created',
        'forum_topic_edited',
        'forum_topic_closed',
        'forum_topic_reopened',
        'general_forum_topic_hidden',
        'general_forum_topic_unhidden',
        'giveaway_created',
        'giveaway',
        'video_chat_scheduled',
        'video_chat_started',
        'video_chat_ended',
        'video_chat_participants_invited',
        'web_app_data',
        'reply_markup',
    ];

    // BelongsTo

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }

    public function sender_chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_sender_chat_id');
    }

    public function sender_business_bot(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_business_bot_id');
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }

    public function reply_to_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_reply_to_message_id');
    }

    public function via_bot(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_via_bot_id');
    }

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class, 'telegram_poll_id');
    }

    public function left_chat_member(): BelongsTo
    {
        return $this->belongsTo(User::class, 'telegram_left_chat_member_id');
    }

    public function pinned_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_pinned_message_id');
    }

    // Attributes

    public function getCommandAttribute(): string
    {
        return $this->text ?? $this->type;
    }
}
