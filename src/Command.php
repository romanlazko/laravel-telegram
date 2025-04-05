<?php

namespace Romanlazko\LaravelTelegram;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;
use Romanlazko\LaravelTelegram\Models\Types\Keyboard\InlineKeyboardMarkup;

abstract class Command extends TelegramApiClient
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected static null|string $command = null;

    protected static null|array $usage = null;

    protected static null|string $botName = null;

    protected static null|string $title = null;

    protected static null|string $type = null;

    public function __construct(protected BaseType $object) {}

    protected function configure(): void
    {
        $this->processResponseUsing(fn ($response, $bot) => $bot->processResponse($response));

        $this->token(fn ($bot) => $bot->getToken());
    }

    protected function authorize(): bool
    {
        return true;
    }

    public function handle(): void
    {
        $this->configure();

        if (! $this->authorize()) {
            return;
        }

        $this->evaluateMethod('execute');
    }

    public function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'object' => [$this->getObject()],
            'inlineKeyboardMarkup' => [$this->getInlineKeyboardMarkup()],
            'inlineData' => [$this->getInlineData()],
            'bot' => [$this->getBot()],
            default => parent::resolveDefaultClosureDependencyForEvaluationByName($parameterName),
        };
    }

    private function getBot(): Bot
    {
        return app(static::getBotName());
    }

    private function getInlineKeyboardMarkup(): InlineKeyboardMarkup
    {
        return $this->evaluate(fn (array $inlineData) => InlineKeyboardMarkup::make()
            ->inlineData($inlineData)
        );
    }

    private function getInlineData(): array
    {
        return $this->evaluate(function (BaseType $object, Bot $bot) {
            $structure = $bot->getInlineDataStructure();

            $raw = $object?->callback_query?->inlineData ?? $structure;

            $data = array_combine(array_keys($structure), array_values($raw));

            foreach ($structure as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = array_combine(array_keys($value), $data[$key]);
                }
            }

            return $data;
        });
    }

    protected function getObject(): BaseType
    {
        return $this->object;
    }

    public static function getBotName(): string
    {
        return static::$botName ?? str(static::class)
            ->after('\\Telegram\\')
            ->before('\\')
            ->toString();
    }

    public static function getUsage(): array
    {
        return static::$usage ?? [
            static::getCommand(),
        ];
    }

    public static function getCommand(): string
    {
        return static::$command ?? str(class_basename(static::class))
            ->replace('Command', '')
            ->snake()
            ->toString();
    }

    public static function getTitle(): string
    {
        return static::$title ?? str(class_basename(static::class))
            ->snake()
            ->replace('_', ' ')
            ->ucfirst()
            ->toString();
    }

    public static function getType(): string
    {
        return static::$type ?? str(static::class)
            ->after('\\Commands\\')
            ->before('\\')
            ->lower()
            ->replace('commands', '')
            ->toString();
    }

    public static function checkUsage(string $command): bool
    {
        return in_array($command, static::getUsage());
    }
}
