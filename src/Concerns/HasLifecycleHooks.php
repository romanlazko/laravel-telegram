<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;

trait HasLifecycleHooks
{
    protected ?Closure $beforeSend = null;

    protected ?Closure $afterSend = null;

    public function before(?Closure $beforeSend = null): static
    {
        $this->beforeSend = $beforeSend;

        return $this;
    }

    public function callBefore()
    {
        $beforeSend = $this->evaluate($this->beforeSend);

        $this->beforeSend = null;

        return $beforeSend;
    }

    public function after(?Closure $afterSend = null): static
    {
        $this->afterSend = $afterSend;

        return $this;
    }

    public function callAfter($response = null)
    {
        $afterSend = $this->evaluate($this->afterSend, ['response' => $response]);

        $this->afterSend = null;

        return $afterSend;
    }

    public function resetLifecycleHooks(): static
    {
        $this->beforeSend = null;

        $this->afterSend = null;

        return $this;
    }
}
