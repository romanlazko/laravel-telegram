<?php

namespace Romanlazko\LaravelTelegram\Console\Commands;

use Illuminate\Console\Command;
use Romanlazko\LaravelTelegram\Models\TelegramBot;
use Romanlazko\LaravelTelegram\Services\StubGenerator;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:telegram-command')]
class MakeCommandCommand extends Command
{
    protected $description = 'Create a new Telegram command class';

    protected $signature = 'make:telegram-command {name?} {--B|bot=} {--A|auth_path=} {--F|force}';

    public function handle(StubGenerator $stubGenerator): bool
    {
        $name = $this->getNameInput();

        $bot_name = $this->getBotNameInput();

        $auth_path = $this->getAuthPathInput($bot_name);

        $path = $this->getPath("{$bot_name}/Commands/{$auth_path}/{$name}");

        return $stubGenerator->generateFileFromStub(
            __DIR__.'/../../stubs/Command.stub',
            $path,
            [
                'namespace' => $this->getNamespace($path),
                'class_name' => $this->getClassName($name),
            ]
        );
    }

    protected function getPath($name): string
    {
        return str($name)
            ->replace('\\', '/')
            ->prepend($this->laravel['path'], '/Telegram/')
            ->append('.php');
    }

    private function getClassName($name): string
    {
        return str($name)
            ->afterLast('\\')
            ->beforeLast('.')
            ->ucfirst();
    }

    protected function getNamespace($path): string
    {
        return str($path)
            ->replace($this->laravel['path'], '')
            ->prepend($this->rootNamespace())
            ->replace('/', '\\')
            ->beforeLast('\\');
    }

    protected function getCommandName($name): string
    {
        return str($name)
            ->afterLast('\\')
            ->beforeLast('.')
            ->snake();
    }

    protected function rootNamespace(): string
    {
        return str($this->laravel->getNamespace())->trim('\\');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace;
    }

    protected function getNameInput(): string
    {
        return str($this->argument('name') ?? text(
            label: 'Enter the command name',
            required: true,
        ))
            ->ltrim('\\/')
            ->replace('/', '\\')
            ->trim()
            ->beforeLast('.php');
    }

    private function getBotNameInput(): string
    {
        $options = TelegramBot::all()->pluck('name');

        if ($options->isEmpty()) {
            $this->error('No bots found');

            exit;
        }

        return str($this->option('bot') ??
            select(
                label: 'Select a bot',
                options: $options,
                required: true,
            ))
            ->trim();
    }

    protected function getAuthPathInput($bot_name): string
    {
        $options = [
            'channel',
            'supergroup',
            'group',
            'default',
        ];

        $roles = array_keys(app($bot_name)->getRoles());

        $options = array_merge($roles, $options);

        return str($this->option('auth_path') ?? select(
            label: 'Select a auth',
            options: $options,
            required: true,
        ))
            ->ucfirst()
            ->append('Commands');
    }
}
