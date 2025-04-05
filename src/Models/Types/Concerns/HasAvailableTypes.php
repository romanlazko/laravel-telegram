<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Concerns;

trait HasAvailableTypes
{
    public function getAvailableTypes(): array
    {
        return $this->availableTypes;
    }

    public function getAvailableType(): ?string
    {
        foreach ($this->getAvailableTypes() as $type) {
            if ($this->isRelation($type) && method_exists($this, $type)) {
                if ($this->relationLoaded($type) && $this->{$type} !== null) {
                    return $type;
                }
            } elseif ($this->checkIfKeyExists($type)) {
                return $type;
            }
        }

        return null;
    }

    protected function checkIfKeyExists(string $key): bool
    {
        return array_key_exists($key, $this->attributes) && ! is_null($this->attributes[$key]);
    }

    public function getTypeAttribute(): ?string
    {
        return $this->getAvailableType();
    }
}
