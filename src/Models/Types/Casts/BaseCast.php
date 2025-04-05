<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;

abstract class BaseCast implements CastsAttributes
{
    public function __construct(protected string $type) {}

    protected function fromRequest(mixed $value, array $attributes): BaseType
    {
        if ($value instanceof BaseType) {
            return $value;
        }

        $typeClass = $this->getClassByType();

        return $typeClass::fromRequest($value, [
            'telegram_bot_id' => $attributes['telegram_bot_id'],
        ]);
    }

    protected function getClassByType(): string
    {
        if (! is_a($this->type, BaseType::class, true)) {
            throw new InvalidArgumentException('The provided class must extend ['.BaseType::class.'].');
        }

        return $this->type;
    }

    public static function using($class): string
    {
        return static::class.':'.$class;
    }
}
