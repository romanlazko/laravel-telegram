<?php

namespace Romanlazko\LaravelTelegram\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Romanlazko\LaravelTelegram\Models\TelegramBot;
use Romanlazko\LaravelTelegram\Services\StubGenerator;
use Romanlazko\LaravelTelegram\TelegramApiClient;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:telegram-bot')]
class MakeTelegramBotCommand extends Command
{
    protected $signature = 'make:telegram-bot {token?} {name?}';

    protected $description = 'Create a new Telegram bot';

    public function handle(): void
    {
        $bot = $this->storeBot();

        $this->createCommandDirectories($bot);
        $this->createProvider($bot);
        $this->setWebhook($bot);
    }

    protected function storeBot(): TelegramBot
    {
        $token = $this->getTokenInput();
        $botInfo = $this->getBotInfo($token);
        $name = $this->getNameInput($botInfo['username']);

        $bot = TelegramBot::updateOrCreate(
            ['telegram_bot_id' => $botInfo['id']],
            [
                'name' => $name,
                'token' => $token,
                'first_name' => $botInfo['first_name'],
                'username' => $botInfo['username'],
            ]
        );

        $this->info("✅ Bot [{$bot->name}] created successfully.");

        return $bot;
    }

    protected function getTokenInput(): string
    {
        return str($this->argument('token') ?? text('Enter the bot token', required: true))
            ->trim();
    }

    protected function getNameInput(string $default): string
    {
        return str($this->argument('name') ?? text('Enter the bot name', default: $default, required: true))
            ->trim()
            ->camel()
            ->ucfirst()
            ->toString();
    }

    protected function getBotInfo(string $token): array
    {
        $response = (new TelegramApiClient)
            ->token($token)
            ->apiMethod('getMe')
            ->send();

        if (! $response['ok']) {
            $this->fail("❌ Failed to fetch bot info: {$response['description']}");
        }

        return $response['result'];
    }

    protected function createCommandDirectories(TelegramBot $bot): void
    {
        $path = base_path("app/Telegram/{$bot->name}/Commands/");

        (new StubGenerator)->generateDirectory($path);

        $this->info("📁 Directory [{$path}] created.");
    }

    protected function createProvider(TelegramBot $bot): void
    {
        $stubPath = __DIR__.'/../../stubs/BotProviderStub.stub';
        $providerPath = base_path("app/Providers/Telegram/{$bot->name}Provider.php");

        (new StubGenerator)->generateFileFromStub($stubPath, $providerPath, [
            'class_name' => "{$bot->name}Provider",
            'bot_name' => $bot->name,
            'bot_id' => $bot->telegram_bot_id,
            'bot_token' => $bot->token,
        ]);

        $this->info("🧩 Service provider generated: {$bot->name}Provider");

        $this->maybeRegisterProvider($bot->name);
    }

    protected function maybeRegisterProvider(string $botName): void
    {
        if (version_compare(App::version(), '11.0', '>=') &&
            file_exists($bootstrapPath = App::getBootstrapProvidersPath())) {

            ServiceProvider::addProviderToBootstrapFile(
                "App\\Providers\\Telegram\\{$botName}Provider",
                $bootstrapPath
            );

            $this->info("📌 Registered [{$botName}Provider] in bootstrap/providers.php");
        }
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
