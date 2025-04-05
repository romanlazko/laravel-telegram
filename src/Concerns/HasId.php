<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;

trait HasId
{
    protected $id;

    public function id(null|int|Closure $id = null): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->evaluate($this->id);
    }
}
