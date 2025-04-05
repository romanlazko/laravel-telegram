<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Casts;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MaybeBooleanType extends BaseCast
{
    public function get(Model $model, string $key, mixed $value, array $attributes): null|bool|BaseType
    {
        if (is_null($value)) {
            return null;
        }

        $value = Json::decode($value);

        if (is_array($value)) {
            return $this->fromRequest($value, $attributes);
        }

        return $value;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): null|bool|string
    {
        if (is_null($value)) {
            return null;
        }

        return Json::encode($value);
    }
}
