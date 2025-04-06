<?php

namespace Romanlazko\LaravelTelegram\Console\Commands;

use Illuminate\Console\Command;
use Romanlazko\LaravelTelegram\Models\TelegramBot;
use Romanlazko\LaravelTelegram\TelegramApiClient;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

#[AsCommand(name: 'telegram:set-webhook')]
class SetWebhook extends Command
{
    protected $signature = 'telegram:set-webhook {--B|bot=}';

    protected $description = 'Set webhook for Telegram bot';

    public function handle(): void
    {
        $bot = TelegramBot::find($this->getBotId());

        $this->setWebhook($bot);
    }

    private function getBotId(): string
    {
        $options = TelegramBot::pluck('name', 'telegram_bot_id')->all();

        return $this->option('bot') ??
            select(
                label: 'Select a bot',
                options: $options,
                required: true,
            );
    }

    protected function setWebhook(TelegramBot $bot): void
    {
        $url = env('APP_URL')."/api/telegram-webhook/{$bot->telegram_bot_id}";
        $allowedUpdates = $this->getAllowedUpdates();

        $response = (new TelegramApiClient)
            ->token($bot->token)
            ->apiMethod('setWebhook')
            ->url($url)
            ->allowedUpdates($allowedUpdates)
            ->send();

        $this->info($response['description']);
    }

    protected function getAllowedUpdates(): array
    {
        return multiselect(
            label: 'Select allowed updates (leave empty for all)',
            options: [
                'message', 'edited_message', 'channel_post', 'edited_channel_post',
                'business_connection', 'business_message', 'edited_business_message',
                'deleted_business_messages', 'message_reaction', 'message_reaction_count',
                'inline_query', 'chosen_inline_result', 'callback_query',
                'shipping_query', 'pre_checkout_query', 'purchased_paid_media',
                'poll', 'poll_answer', 'my_chat_member', 'chat_member',
                'chat_join_request', 'chat_boost', 'removed_chat_boost',
            ]
        );
    }
}