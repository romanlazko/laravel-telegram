<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Casts;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CollectionOfCollectionOfType extends BaseCast
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Collection
    {
        if (! isset($attributes[$key])) {
            return null;
        }

        $value = Json::decode($attributes[$key]);

        if (! is_array($value)) {
            return null;
        }

        foreach ($value as $collectionValue) {
            foreach ($collectionValue as $array) {
                $value[][] = $this->fromRequest($array, $attributes);
            }
        }

        return collect($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        $values = [];

        foreach ($value as $collectionValue) {
            foreach ($collectionValue as $array) {
                $values[][] = $this->fromRequest($array, $attributes);
            }
        }

        return Json::encode($values);
    }
}
