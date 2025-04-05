<?php

namespace Romanlazko\LaravelTelegram\Concerns;

use Closure;

trait HasToken
{
    /** @var string */
    protected $token = null;

    public function token(string|Closure $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getToken(): string
    {
        $token = $this->evaluate($this->token);

        $this->validateToken($token);

        return (string) $token;
    }

    private function validateToken(string $token): void
    {
        if (empty($token) or $token === '') {
            throw new \InvalidArgumentException('Telegram token is required');
        }

        if (strlen($token) < 30) {
            throw new \InvalidArgumentException('Telegram token is too short');
        }

        if (! preg_match('/^(\d+):.*$/', $token)) {
            throw new \InvalidArgumentException('Telegram token must be in the format "123456789:ABC-DEF1234ghIkl-zyx57W2v1u123ew11"');
        }
    }
}
