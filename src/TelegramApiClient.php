<?php

namespace Romanlazko\LaravelTelegram;

use Closure;
use Illuminate\Support\Facades\Http;
use Romanlazko\LaravelTelegram\Concerns\CanProcessResponse;
use Romanlazko\LaravelTelegram\Concerns\EvaluatesClosures;
use Romanlazko\LaravelTelegram\Concerns\HasLifecycleHooks;
use Romanlazko\LaravelTelegram\Concerns\HasProperties;
use Romanlazko\LaravelTelegram\Concerns\HasToken;

class TelegramApiClient
{
    use CanProcessResponse;
    use EvaluatesClosures;
    use HasLifecycleHooks;
    use HasProperties;
    use HasToken;

    /** @var string */
    protected $baseUrl = 'https://api.telegram.org/bot';

    protected $apiMethod = null;

    public function send()
    {
        $this->callBefore();

        $response = $this->sendRequest();

        $processedResponse = $this->processResponse($response);

        $this->callAfter($processedResponse);

        return $processedResponse;
    }

    private function sendRequest(): array
    {
        return (array) $this->evaluate(fn ($endpoint, $properties) => Http::post($endpoint, $properties)->throw()->json()
        ) + ['apiMethod' => $this->getApiMethod()];
    }

    public function getEndpoint(): string
    {
        return $this->baseUrl.$this->getToken().'/'.$this->getApiMethod();
    }

    public function apiMethod(string|Closure $apiMethod): static
    {
        $this->apiMethod = $apiMethod;

        return $this;
    }

    public function getApiMethod(): string
    {
        return (string) $this->evaluate($this->apiMethod);
    }

    public function __clone()
    {
        $this->resetLifecycleHooks();
        $this->resetProperties();
    }

    public function resolveDefaultClosureDependencyForEvaluationByName(string $parameterName): array
    {
        return match ($parameterName) {
            'token' => [$this->getToken()],
            'baseUrl' => [$this->baseUrl],
            'properties' => [$this->getProperties()],
            'apiMethod' => [$this->getApiMethod()],
            'endpoint' => [$this->getEndpoint()],
            'client' => [clone $this],
            default => [],
        };
    }
}
