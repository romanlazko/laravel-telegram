<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Keyboard;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class InlineKeyboardMarkup implements Arrayable, JsonSerializable
{
    protected array $schema = [];

    protected array|Closure $inlineData = [];

    public static function make(array $schema = []): static
    {
        $instance = new static;

        $instance->schema($schema);

        return $instance;
    }

    public function schema(array $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function inlineData(array|Closure $inlineData): static
    {
        $this->inlineData = $inlineData;

        return $this;
    }

    public function getInlineData(): array
    {
        return $this->inlineData;
    }

    protected function getSchema(): array
    {
        $keyboard_rows = [];

        foreach ($this->schema as $row => $columns) {
            $keyboard_columns = [];

            foreach ($columns as $button) {
                if (! $button->isVisible()) {
                    continue;
                }

                $keyboard_columns[] = $button
                    ->callbackDataStructure($this->getInlineData())
                    ->render();
            }

            $keyboard_rows[] = $keyboard_columns;
        }

        return ['inline_keyboard' => $keyboard_rows];
    }

    public function toArray(): array
    {
        return $this->getSchema();
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
