<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Romanlazko\LaravelTelegram\Models\Types\Attachments\File;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Poll;
use Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker\Sticker;
use Romanlazko\LaravelTelegram\Models\Types\Bot\BotCommand;
use Romanlazko\LaravelTelegram\Models\Types\Bot\BotDescription;
use Romanlazko\LaravelTelegram\Models\Types\Bot\BotName;
use Romanlazko\LaravelTelegram\Models\Types\Bot\BotShortDescription;
use Romanlazko\LaravelTelegram\Models\Types\Business\BusinessConnection;
use Romanlazko\LaravelTelegram\Models\Types\Casts\CollectionOfType;
use Romanlazko\LaravelTelegram\Models\Types\Casts\Type;
use Romanlazko\LaravelTelegram\Models\Types\ChatBoost\UserChatBoosts;
use Romanlazko\LaravelTelegram\Models\Types\ChatMember\ChatAdministratorRights;
use Romanlazko\LaravelTelegram\Models\Types\ChatMember\ChatInviteLink;
use Romanlazko\LaravelTelegram\Models\Types\ChatMember\ChatMember;
use Romanlazko\LaravelTelegram\Models\Types\Forum\ForumTopic;
use Romanlazko\LaravelTelegram\Models\Types\MenuButton\MenuButton;
use Romanlazko\LaravelTelegram\Models\Types\Message\MessageId;

class Response extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'ok' => 'boolean',
            'description' => 'string',
            'error_code' => 'integer',
            'apiMethod' => 'string',
        ];
    }

    public static function fromRequest(array $data, array $attributes = [])
    {
        $instance = (new static)->findUniqueModel($data, $attributes);

        $instance->mergeCasts([
            'result' => $instance->getCastsTypeFromApiMethod($data['apiMethod']),
        ]);

        $instance->fill(array_merge($attributes, $data));

        $instance->fillRelations(array_merge($data, $attributes), $attributes);

        $instance->saveWithRelations();

        return $instance;
    }

    protected function getCastsTypeFromApiMethod($apiMethod)
    {
        return match ($apiMethod) {
            'getMe' => Type::using(User::class),
            'logOut' => 'boolean',
            'close' => 'boolean',
            'forwardMessages' => CollectionOfType::using(MessageId::class),
            'copyMessage' => Type::using(MessageId::class),
            'copyMessages' => CollectionOfType::using(MessageId::class),
            'sendMediaGroup' => CollectionOfType::using(Message::class),
            'sendChatAction' => 'boolean',
            'setMessageReaction' => 'boolean',
            'getUserProfilePhotos' => Type::using(UserProfilePhotos::class),
            'setUserEmojiStatus' => 'boolean',
            'getFile' => Type::using(File::class),
            'banChatMember' => 'boolean',
            'unbanChatMember' => 'boolean',
            'restrictChatMember' => 'boolean',
            'promoteChatMember' => 'boolean',
            'setChatAdministratorCustomTitle' => 'boolean',
            'banChatSenderChat' => 'boolean',
            'unbanChatSenderChat' => 'boolean',
            'setChatPermissions' => 'boolean',
            'exportChatInviteLink' => 'string',
            'createChatInviteLink' => Type::using(ChatInviteLink::class),
            'editChatInviteLink' => Type::using(ChatInviteLink::class),
            'createChatSubscriptionInviteLink' => Type::using(ChatInviteLink::class),
            'editChatSubscriptionInviteLink' => Type::using(ChatInviteLink::class),
            'revokeChatInviteLink' => Type::using(ChatInviteLink::class),
            'approveChatJoinRequest' => 'boolean',
            'declineChatJoinRequest' => 'boolean',
            'setChatPhoto' => 'boolean',
            'deleteChatPhoto' => 'boolean',
            'setChatTitle' => 'boolean',
            'setChatDescription' => 'boolean',
            'pinChatMessage' => 'boolean',
            'unpinChatMessage' => 'boolean',
            'unpinAllChatMessages' => 'boolean',
            'leaveChat' => 'boolean',
            'getChat' => Type::using(Chat::class),
            'getChatAdministrators' => CollectionOfType::using(ChatMember::class),
            'getChatMemberCount' => 'integer',
            'getChatMember' => Type::using(ChatMember::class),
            'setChatStickerSet' => 'boolean',
            'deleteChatStickerSet' => 'boolean',
            'getForumTopicIconStickers' => CollectionOfType::using(Sticker::class),
            'createForumTopic' => Type::using(ForumTopic::class),
            'editForumTopic' => 'boolean',
            'closeForumTopic' => 'boolean',
            'reopenForumTopic' => 'boolean',
            'deleteForumTopic' => 'boolean',
            'unpinAllForumTopicMessages' => 'boolean',
            'editGeneralForumTopic' => 'boolean',
            'closeGeneralForumTopic' => 'boolean',
            'reopenGeneralForumTopic' => 'boolean',
            'hideGeneralForumTopic' => 'boolean',
            'unhideGeneralForumTopic' => 'boolean',
            'unpinAllGeneralForumTopicMessages' => 'boolean',
            'answerCallbackQuery' => 'boolean',
            'getUserChatBoosts' => CollectionOfType::using(UserChatBoosts::class),
            'getBusinessConnection' => Type::using(BusinessConnection::class),
            'setMyCommands' => 'boolean',
            'deleteMyCommands' => 'boolean',
            'getMyCommands' => CollectionOfType::using(BotCommand::class),
            'setMyName' => 'boolean',
            'getMyName' => Type::using(BotName::class),
            'setMyDescription' => 'boolean',
            'getMyDescription' => Type::using(BotDescription::class),
            'setMyShortDescription' => 'boolean',
            'getMyShortDescription' => Type::using(BotShortDescription::class),
            'setChatMenuButton' => 'boolean',
            'getChatMenuButton' => Type::using(MenuButton::class),
            'setMyDefaultAdministratorRights' => 'boolean',
            'getMyDefaultAdministratorRights' => Type::using(ChatAdministratorRights::class),
            'stopPoll' => Type::using(Poll::class),
            'deleteMessage' => 'boolean',
            'deleteMessages' => 'boolean',
            default => Type::using(Message::class),
        };
    }
}
