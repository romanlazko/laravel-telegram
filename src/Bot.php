<?php

namespace Romanlazko\LaravelTelegram;

use Illuminate\Http\Request;
use Romanlazko\LaravelTelegram\Concerns\CanGetUpdateFromRequest;
use Romanlazko\LaravelTelegram\Concerns\CanProcessResponse;
use Romanlazko\LaravelTelegram\Concerns\EvaluatesClosures;
use Romanlazko\LaravelTelegram\Concerns\HasCommands;
use Romanlazko\LaravelTelegram\Concerns\HasId;
use Romanlazko\LaravelTelegram\Concerns\HasRoles;
use Romanlazko\LaravelTelegram\Concerns\HasToken;
use Romanlazko\LaravelTelegram\Models\Types\Response;
use Romanlazko\LaravelTelegram\Models\Types\Update;

class Bot
{
    use CanGetUpdateFromRequest;
    use CanProcessResponse;
    use EvaluatesClosures;
    use HasCommands;
    use HasId;
    use HasRoles;
    use HasToken;

    public const ROLE_USER = 'user';

    public const DEFAULT_COMMAND_TYPE = 'default';

    protected array $inline_data_structure = [];

    public function __construct()
    {
        $this->processResponseUsing(function (array $response) {
            return Response::fromRequest($response, [
                'telegram_bot_id' => $this->getId(),
            ]);
        });

        $this->getUpdateFromRequestUsing(function (Request $request) {
            return Update::fromRequest($request->only([
                'update_id',
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
            ]), [
                'telegram_bot_id' => $this->getId(),
            ]);
        });

        $this->getCommandClassFromUpdateUsing(function (Update $update) {
            $type = $this->getCommandTypeFromUpdate($update);

            $commandClass = $this->getCommandClass($update->command, $type);
            $expectationClass = $this->getCommandClass($update->chat?->conversation?->getExpectation(), $type);
            $defaultClass = $this->getCommandClass('default', $type);

            return $commandClass ?? $expectationClass ?? $defaultClass;
        });
    }

    public static function make(): static
    {
        return new static;
    }

    public function inlineDataStructure(array $data): static
    {
        $this->inline_data_structure = $data;

        return $this;
    }

    public function getInlineDataStructure(): array
    {
        return $this->inline_data_structure;
    }

    public function processRequest(Request $request): void
    {
        $update = $this->getUpdateFromRequest($request);

        $commandClass = $this->getCommandClassFromUpdate($update);

        if ($commandClass and is_a($commandClass, Command::class, true)) {
            $commandClass::dispatch($update);
        }
    }

    private function getCommandTypeFromUpdate(Update $update): string
    {
        $type = match ($update->type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post',
            'business_message',
            'edited_business_message',
            'callback_query' => $this->getChatTypeFromUpdate($update),
            default => $update->type,
        };

        return array_key_exists($type, $this->getCommands())
            ? $type
            : self::DEFAULT_COMMAND_TYPE;
    }

    protected function getChatTypeFromUpdate(Update $update): string
    {
        return match ($update?->chat?->type) {
            'private' => $this->getAuthFromUpdate($update),
            'group' => 'group',
            'supergroup' => 'supergroup',
            'channel' => 'channel',
        };
    }

    protected function getAuthFromUpdate(Update $update): string
    {
        foreach ($this->getRoles() as $role => $roleIds) {
            if (in_array($update->user?->id, $roleIds)) {
                return $role;
            }
        }

        return self::ROLE_USER;
    }
}
