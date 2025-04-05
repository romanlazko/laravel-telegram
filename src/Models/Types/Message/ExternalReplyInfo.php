<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Message;

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
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\Chat;
use Romanlazko\LaravelTelegram\Models\Types\Giveaway\Giveaway;
use Romanlazko\LaravelTelegram\Models\Types\Giveaway\GiveawayWinners;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageOrigin\MessageOrigin;
use Romanlazko\LaravelTelegram\Models\Types\PaidMedia\PaidMediaInfo;
use Romanlazko\LaravelTelegram\Models\Types\Payments\Invoice;

class ExternalReplyInfo extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'origin' => Type::using(MessageOrigin::class),
            'message_id' => 'integer',
            'link_preview_options' => Type::using(LinkPreviewOptions::class),
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
            'has_media_spoiler' => 'boolean',
            'contact' => Type::using(Contact::class),
            'dice' => Type::using(Dice::class),
            'game' => Type::using(Game::class),
            'giveaway' => Type::using(Giveaway::class),
            'giveaway_winners' => Type::using(GiveawayWinners::class),
            'invoice' => Type::using(Invoice::class),
            'location' => Type::using(Location::class),
            'venue' => Type::using(Venue::class),
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class, 'telegram_poll_id');
    }
}
