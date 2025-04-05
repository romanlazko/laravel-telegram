<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Poll;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\PollAnswer;
use Romanlazko\LaravelTelegram\Models\Types\Business\BusinessConnection;
use Romanlazko\LaravelTelegram\Models\Types\Business\BusinessMessagesDeleted;
use Romanlazko\LaravelTelegram\Models\Types\ChatBoost\ChatBoostRemoved;
use Romanlazko\LaravelTelegram\Models\Types\ChatBoost\ChatBoostUpdated;
use Romanlazko\LaravelTelegram\Models\Types\ChatMember\ChatJoinRequest;
use Romanlazko\LaravelTelegram\Models\Types\ChatMember\ChatMemberUpdated;
use Romanlazko\LaravelTelegram\Models\Types\Concerns\HasAvailableTypes;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\PaidMedia\PaidMediaPurchased;
use Romanlazko\LaravelTelegram\Models\Types\Payments\PreCheckoutQuery;
use Romanlazko\LaravelTelegram\Models\Types\Payments\ShippingQuery;
use Romanlazko\LaravelTelegram\Models\Types\ReactionType\MessageReactionCountUpdated;
use Romanlazko\LaravelTelegram\Models\Types\ReactionType\MessageReactionUpdated;

class Update extends BaseType implements ShouldBeSaved
{
    use HasAvailableTypes;

    protected $table = 'telegram_updates';

    protected $primaryKey = 'telegram_update_id';

    protected $availableTypes = [
        'message',
        'edited_message',
        'channel_post',
        'edited_channel_post',
        'business_connection',
        'business_message',
        'edited_business_message',
        'deleted_business_messages',
        'message_reaction',
        'message_reaction_count',
        'inline_query',
        'chosen_inline_result',
        'callback_query',
        'shipping_query',
        'pre_checkout_query',
        'purchased_paid_media',
        'poll',
        'poll_answer',
        'my_chat_member',
        'chat_member',
        'chat_join_request',
    ];

    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'update_id' => 'integer',
        ];
    }

    // BelongsTo

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_message_id');
    }

    public function edited_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_edited_message_id');
    }

    public function channel_post(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_channel_post_id');
    }

    public function edited_channel_post(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_edited_channel_post_id');
    }

    public function business_connection(): BelongsTo
    {
        return $this->belongsTo(BusinessConnection::class, 'telegram_business_connection_id');
    }

    public function business_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_business_message_id');
    }

    public function edited_business_message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'telegram_edited_business_message_id');
    }

    public function deleted_business_messages(): BelongsTo
    {
        return $this->belongsTo(BusinessMessagesDeleted::class, 'telegram_deleted_business_messages_id');
    }

    public function message_reaction(): BelongsTo
    {
        return $this->belongsTo(MessageReactionUpdated::class, 'telegram_message_reaction_id');
    }

    public function message_reaction_count(): BelongsTo
    {
        return $this->belongsTo(MessageReactionCountUpdated::class, 'telegram_message_reaction_count_id');
    }

    public function inline_query(): BelongsTo
    {
        return $this->belongsTo(InlineQuery::class, 'telegram_inline_query_id');
    }

    public function chosen_inline_result(): BelongsTo
    {
        return $this->belongsTo(ChosenInlineResult::class, 'telegram_chosen_inline_result_id');
    }

    public function callback_query(): BelongsTo
    {
        return $this->belongsTo(CallbackQuery::class, 'telegram_callback_query_id');
    }

    public function shipping_query(): BelongsTo
    {
        return $this->belongsTo(ShippingQuery::class, 'telegram_shipping_query_id');
    }

    public function pre_checkout_query(): BelongsTo
    {
        return $this->belongsTo(PreCheckoutQuery::class, 'telegram_pre_checkout_query_id');
    }

    public function purchsed_paid_media(): BelongsTo
    {
        return $this->belongsTo(PaidMediaPurchased::class, 'telegram_purchased_paid_media_id');
    }

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class, 'telegram_poll_id');
    }

    public function poll_answer(): BelongsTo
    {
        return $this->belongsTo(PollAnswer::class, 'telegram_poll_answer_id');
    }

    public function my_chat_member(): BelongsTo
    {
        return $this->belongsTo(ChatMemberUpdated::class, 'telegram_my_chat_member_id');
    }

    public function chat_member(): BelongsTo
    {
        return $this->belongsTo(ChatMemberUpdated::class, 'telegram_chat_member_id');
    }

    public function chat_join_request(): BelongsTo
    {
        return $this->belongsTo(ChatJoinRequest::class, 'telegram_chat_join_request_id');
    }

    public function chat_boost(): BelongsTo
    {
        return $this->belongsTo(ChatBoostUpdated::class, 'telegram_chat_boost_id');
    }

    public function remove_chat_boost(): BelongsTo
    {
        return $this->belongsTo(ChatBoostRemoved::class, 'telegram_chat_boost_removed_id');
    }

    public function getChatAttribute(): ?Chat
    {
        return
            $this->message->chat
            ?? $this->edited_message->chat
            ?? $this->channel_post->chat
            ?? $this->edited_channel_post->chat
            ?? $this->business_message->chat
            ?? $this->edited_business_message->chat
            ?? $this->deleted_business_messages->chat
            ?? $this->message_reaction->chat
            ?? $this->message_reaction_count->chat
            ?? $this->callback_query->message->chat
            ?? $this->poll_answer->voter_chat->chat
            ?? $this->my_chat_member->chat
            ?? $this->chat_member->chat
            ?? $this->chat_join_request->chat
            ?? $this->chat_boost->chat
            ?? $this->remove_chat_boost->chat
            ?? null;
    }

    public function getUserAttribute(): ?User
    {
        return
            $this->message->from
            ?? $this->edited_message->from
            ?? $this->channel_post->from
            ?? $this->edited_channel_post->from
            ?? $this->business_connection->user
            ?? $this->business_message->from
            ?? $this->edited_business_message->from
            ?? $this->message_reaction->user
            ?? $this->inline_query->from
            ?? $this->chosen_inline_result->from
            ?? $this->callback_query->from
            ?? $this->shipping_query->from
            ?? $this->pre_checkout_query->from
            ?? $this->purchased_paid_media->from
            ?? $this->poll_answer->user
            ?? $this->my_chat_member->from
            ?? $this->chat_member->from
            ?? $this->chat_join_request->from
            ?? null;
    }

    public function getCommandAttribute(): string
    {
        return match ($this->type) {
            'message' => $this->message->command,
            'edited_message' => $this->edited_message->command,
            'channel_post' => $this->channel_post->command,
            'edited_channel_post' => $this->edited_channel_post->command,
            'business_message' => $this->business_message->command,
            'edited_business_message' => $this->edited_business_message->command,
            'callback_query' => $this->callback_query->command,
            'inline_query' => $this->inline_query->query,
            'chosen_inline_result' => $this->chosen_inline_result->query,
            default => $this->type,
        };
    }
}
