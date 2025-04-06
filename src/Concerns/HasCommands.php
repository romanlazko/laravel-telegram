<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;
use Illuminate\Filesystem\Filesystem;
use ReflectionClass;
use Romanlazko\LaravelTelegram\Command;
use Romanlazko\LaravelTelegram\Models\Types\Update;

trait HasCommands
{
    protected array $commands = [];

    private Closure $getCommandClassFromUpdateUsing;

    public function discoverCommands(string $directory, string $namespace): static
    {
        if (blank($directory) || blank($namespace)) {
            throw new \Exception('Invalid directory or namespace');
        }

        $filesystem = app(Filesystem::class);

        if ((! $filesystem->exists($directory))) {
            throw new \Exception('Directory not found: '.$directory);
        }

        foreach ($filesystem->allFiles($directory) as $file) {
            $class = (string) str($namespace)
                ->append('\\', $file->getRelativePathname())
                ->replace([DIRECTORY_SEPARATOR, '.php'], ['\\', '']);

            if (! class_exists($class)) {
                continue;
            }

            if ((new ReflectionClass($class))->isAbstract()) {
                continue;
            }

            if (! is_a($class, Command::class, true)) {
                continue;
            }

            $this->registerCommand($class);
        }

        return $this;
    }

    private function registerCommand(string $class): void
    {
        $type = $class::getType();
        $command = $class::getCommand();

        if (isset($this->commands[$type]) and in_array($command, $this->commands[$type])) {
            throw new \Exception("Command with name [{$command}] already exists for type [{$type}].");
        }

        data_set($this->commands, $type.'.'.$command, $class);
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function getCommandClassFromUpdateUsing(Closure $callback): static
    {
        $this->getCommandClassFromUpdateUsing = $callback;

        return $this;
    }

    public function getCommandClassFromUpdate(Update $update): ?string
    {
        $commandClass = (string) $this->evaluate($this->getCommandClassFromUpdateUsing, ['update' => $update]);

        if (! $commandClass or ! is_a($commandClass, Command::class, true)) {
            throw new \Exception("{$commandClass} is not a subclass of Command::class");
        }

        return $commandClass;
    }

    private function getCommandClass(string $command, string $type): ?string
    {
        if (blank($command) or blank($type)) {
            return null;
        }

        $command = str($command)->lower()->toString();

        return collect(data_get($this->getCommands(), $type, []))
            ->first(function ($class) use ($command) {
                return class_exists($class) && $class::checkUsage($command);
            });
    }
}
