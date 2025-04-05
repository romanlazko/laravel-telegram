<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;
use Illuminate\Http\Request;
use Romanlazko\LaravelTelegram\Models\Types\Update;

trait CanGetUpdateFromRequest
{
    protected $getUpdateFromRequestUsing = null;

    public function getUpdateFromRequestUsing(?Closure $callback)
    {
        $this->getUpdateFromRequestUsing = $callback;
    }

    protected function getUpdateFromRequest(Request $request): Update
    {
        return (object) $this->evaluate($this->getUpdateFromRequestUsing, ['request' => $request]);
    }
}
