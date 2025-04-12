# Laravel Telegram Bot Integration

[![Latest Version](https://img.shields.io/packagist/v/romanlazko/laravel-telegram.svg?style=flat-square)](https://packagist.org/packages/romanlazko/laravel-telegram)
[![License](https://img.shields.io/github/license/romanlazko/laravel-telegram.svg?style=flat-square)](LICENSE)

The `laravel-telegram` package provides a seamless integration between Laravel applications and the [Telegram Bot API](https://core.telegram.org/bots/api). It enables developers to easily build Telegram bots with clean, expressive Laravel syntax, and supports features such as:

- Bot creation and registration via Artisan
- Webhook management
- Command-based architecture
- Automatic injection of Telegram update data (Chat, Message, CallbackQuery, etc.)
- Full support for Laravel queues

---

## 🚀 Installation

Install the package using Composer:

```bash
composer require romanlazko/laravel-telegram
```

### Optional: Publish Migrations

```bash
php artisan vendor:publish --tag=laravel-telegram-migrations
```

---

## 🤖 Create a Bot

Use the following command to register a bot with your Laravel application:

```bash
php artisan telegram:bot YOUR_BOT_TOKEN
```

This will generate a new service provider at:

```
app/Providers/Telegram/BotNameProvider.php
```

### Registering the Provider

Ensure the generated service provider is registered:

- **Laravel 11+**: in `bootstrap/providers.php`
- **Laravel 10 and below**: in `config/app.php` under the `providers` array

Add it manually if it was not auto-registered.

---

## 🌐 Set the Webhook

To set the Telegram webhook for your bot:

```bash
php artisan telegram:set-webhook telegram_bot_id
```

The webhook URL defaults to:

```
https://your-app-url.com/api/telegram-webhook/{telegram_bot_id}
```

### Local Development

Use [ngrok](https://ngrok.com) to expose your local server:

```bash
ngrok http 8000
```

Then update `.env`:

```env
APP_URL=https://your-ngrok-url.ngrok.io
```

Re-run the webhook command after updating the URL.

---

## 📦 Creating Commands

Commands are the main way to handle user interactions with the bot. Each command is a Laravel Job that responds to Telegram updates.

Generate a new command with:

```bash
php artisan telegram:command DefaultCommand
```

This creates a file at:

```
app/Telegram/BotName/Commands/DefaultCommand.php
```

---

## ✨ Example Command

```php
namespace App\Telegram\MyBot\Commands;

use Romanlazko\LaravelTelegram\Command;
use Romanlazko\LaravelTelegram\Models\Types\Chat;

class DefaultCommand extends Command
{
    public function execute(Chat $chat)
    {
        $this->apiMethod('sendMessage');
        $this->text('My first command!');
        $this->chatId($chat->id);
        $this->parseMode('Markdown');

        return $this->send();
    }

    public function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'update' => [$this->getObject()],
            'message' => [$this->evaluate(fn ($update) => $update->message ?? $update->callback_query->message)],
            'chat' => [$this->evaluate(fn ($message) => $message->chat)],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }
}
```

---

## 🧠 Dependency Injection

Your command’s `execute()` method can declare parameters like:

- `Update`
- `Message`
- `Chat`
- `CallbackQuery`

These will be resolved and injected automatically from the incoming Telegram update.

You can override the method `resolveDefaultClosureDependencyForEvaluationByName()` to customize how dependencies are resolved.

---

## ✅ Features at a Glance

- [x] Support for multiple bots
- [x] Laravel-native syntax
- [x] Webhook auto-registration
- [x] Commands as Laravel Jobs
- [x] Dependency injection
- [x] Clean architecture

---

## 📚 Resources

- [Telegram Bot API](https://core.telegram.org/bots/api)
- [Laravel Service Providers](https://laravel.com/docs/providers)
- [Laravel Queues](https://laravel.com/docs/queues)

---

## 📝 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 💬 Support

Feel free to open issues or contribute with PRs. Happy bot building 🤖!