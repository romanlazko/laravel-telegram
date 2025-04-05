<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Concerns;

trait HasUniqueKey
{
    protected $uniqueKey = null;

    public function getUniqueKey(): string
    {
        return $this->uniqueKey ?? $this->primaryKey;
    }
}
