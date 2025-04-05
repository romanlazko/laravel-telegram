<?php

namespace Romanlazko\LaravelTelegram\Concerns;

trait HasProperties
{
    protected array $properties = [];

    public function properties(array $properties): static
    {
        foreach ($properties as $key => $value) {
            $this->setProperty($key, $value);
        }

        return $this;
    }

    public function getProperties()
    {
        $properties = [];

        foreach ($this->properties as $key => $value) {
            $properties[$key] = $this->evaluate($value);
        }

        return $properties;
    }

    public function resetProperties(): static
    {
        $this->properties = [];

        return $this;
    }

    public function __call($name, $arguments): static
    {
        $propertyName = str($name)->snake()->toString();

        return $this->setProperty($propertyName, $arguments[0]);
    }

    public function setProperty($name, mixed $value): static
    {
        $this->properties[$name] = $value;

        return $this;
    }
}
