<?php

namespace Romanlazko\LaravelTelegram\Models\Types;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Cache;
use Romanlazko\LaravelTelegram\Models\TelegramBot;
use Romanlazko\LaravelTelegram\Models\Types\Concerns\HasUniqueKey;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeSaved;
use Romanlazko\LaravelTelegram\Models\Types\Contracts\ShouldBeUnique;

abstract class BaseType extends Model
{
    use HasUniqueKey;

    public function toArray(): array
    {
        return array_filter(parent::toArray());
    }

    public function getFillable(): array
    {
        return array_merge(parent::getFillable(), array_keys($this->getCasts()));
    }

    public function telegram_bot(): BelongsTo
    {
        return $this->belongsTo(TelegramBot::class, 'telegram_bot_id');
    }

    public static function fromRequest(array $data, array $attributes = [])
    {
        $instance = (new static)->findUniqueModel($data, $attributes);

        $instance->fill(array_merge($attributes, $data));

        $instance->fillRelations(array_merge($data, $attributes), $attributes);

        $instance->saveWithRelations();

        return $instance;
    }

    public function fillRelations(array $data, array $attributes = [])
    {
        foreach ($data as $key => $value) {
            if (! $this->isRelation($key)) {
                continue;
            }

            $relationship = $this->getRelationship($key);
            $related = $relationship->getRelated();

            if ($relationship instanceof BelongsTo) {
                $relationship->associate($related::fromRequest($value, $attributes));
            }
        }
    }

    protected function getRelationship(string $relationshipName): BelongsTo|BelongsToMany|HasOneOrMany|HasManyThrough|MorphMany|null
    {
        if (blank($relationshipName)) {
            return null;
        }

        if ($this->isRelation($relationshipName)) {
            return $this->{$relationshipName}();
        }

        return null;
    }

    public function findUniqueModel(array $data, array $attributes = []): BaseType
    {
        if ($this->shouldBeUnique() and $this->shouldBeSaved()) {

            $uniqueKey = $this->getUniqueKey();

            $uniqueValue = data_get($data, $uniqueKey);

            $cacheKey = $this->getRelationCacheKey($this, $uniqueValue).implode('_', $attributes);

            $uniqueModel = Cache::remember($cacheKey, 60, fn () => $this->firstWhere([
                $uniqueKey => $uniqueValue,
                ...$attributes,
            ])
            );
        }

        return $uniqueModel ?? $this->newModelInstance();
    }

    public function shouldBeUnique(): bool
    {
        return $this instanceof ShouldBeUnique;
    }

    public function shouldBeSaved(): bool
    {
        return $this instanceof ShouldBeSaved;
    }

    public function saveWithRelations()
    {
        if ($this->shouldBeSaved()) {
            $this->save();
        }
    }

    protected function getRelationCacheKey(Model $model, $value): string
    {
        return sprintf(strtolower(get_class($model)).'-%d', $value);
    }
}
