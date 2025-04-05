<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Contracts;

interface ShouldBeUnique
{
    public function getUniqueKey(): string;
}
