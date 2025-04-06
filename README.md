## Telegram Package for Laravel

## Installation
You can install the package via composer:

```bash
composer require romanlazko/laravel-telegram
```

#### Optional
You can publish the migration file with:

```bash
php artisan vendor:publish --tag=laravel-telegram-migrations
```

## Usage

Create the bot:
```bash
php artisan make:telegram-bot --token={token} --name=MyBot
```

Latest Laravel versions have auto dicovery and automatically add service provider - if you're using 5.4.x and below, remember to add it to providers array at /app/config/app.php:

```php
App\Providers\Telegram\MyBotProvider::class,
```

Create the commands:
```bash
php artisan make:telegram-command
```
