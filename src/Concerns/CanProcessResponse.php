<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;

trait CanProcessResponse
{
    protected $processResponseUsing = null;

    public function processResponseUsing(?Closure $processResponseUsing = null): static
    {
        $this->processResponseUsing = $processResponseUsing;

        return $this;
    }

    public function processResponse(mixed $response): mixed
    {
        if (is_null($this->processResponseUsing)) {
            return $response;
        }

        return $this->evaluate($this->processResponseUsing, ['response' => $response]);
    }
}
