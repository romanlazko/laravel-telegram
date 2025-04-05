## Telegram Package for Laravel

#### Installation
- Run the command: `composer require romanlazko/laravel-telegram`

## Optional
- Publish the migrations: `php artisan vendor:publish --tag=laravel-telegram-migrations`
- If Laravel is version 10 or lower, add the Romanlazko\LaravelTelegram\TelegramServiceProvider to the `config/app.php` service providers array.

#### Usage
- Create the bot: `php artisan make:telegram-bot`

- Create the commands: `php artisan make:telegram-command`