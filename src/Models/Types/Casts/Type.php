<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Casts;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class Type extends BaseCast
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?BaseType
    {
        if (is_null($value)) {
            return null;
        }

        $value = Json::decode($value);

        if (! is_array($value)) {
            return null;
        }

        return $this->fromRequest($value, $attributes);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        return $this->fromRequest($value, $attributes)->toJson();
    }
}
