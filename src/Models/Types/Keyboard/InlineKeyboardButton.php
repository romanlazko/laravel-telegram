<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Keyboard;

use Closure;
use InvalidArgumentException;
use Romanlazko\LaravelTelegram\Command;
use Romanlazko\LaravelTelegram\Concerns\EvaluatesClosures;

class InlineKeyboardButton
{
    use EvaluatesClosures;

    protected null|string|Closure $command = null;

    protected null|string|Closure $text = null;

    protected null|string|Closure $url = null;

    protected null|string|Closure $web_app_url = null;

    protected null|string|Closure $switch_inline_query = null;

    protected null|string|Closure $switch_inline_query_current_chat = null;

    protected bool|Closure $visible = true;

    protected array|Closure $callback_data = [];

    protected array|Closure $callback_data_structure = [];

    public function __construct(string $command)
    {
        $this->command($command);
    }

    public static function make(string $command): static
    {
        $instance = new static($command);

        if (class_exists($command) and is_a($command, Command::class, true)) {
            $instance->command($command::getCommand());
            $instance->text($command::getTitle());
        }

        return $instance;
    }

    public function command(string|Closure $command): static
    {
        $this->command = $command;

        return $this;
    }

    protected function getCommand(): string
    {
        return (string) $this->evaluate($this->command);
    }

    public function text(string|Closure $text): static
    {
        $this->text = $text;

        return $this;
    }

    protected function getText(): string
    {
        return $this->evaluate($this->text) ?? str($this->getCommand())
            ->snake()
            ->lower()
            ->replace('_', ' ')
            ->ucfirst()
            ->toString();
    }

    public function url(string|Closure $url): static
    {
        $this->url = $url;

        return $this;
    }

    protected function getUrl(): ?string
    {
        return $this->evaluate($this->url);
    }

    public function webAppUrl(string|Closure $web_app_url): static
    {
        $this->web_app_url = $web_app_url;

        return $this;
    }

    protected function getWebApp(): ?array
    {
        $web_app_url = $this->evaluate($this->web_app_url);

        return (! is_null($web_app_url)) ? ['url' => $web_app_url] : null;
    }

    public function visible(bool|Closure $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function isVisible(): bool
    {
        return (bool) $this->evaluate($this->visible);
    }

    public function switchInlineQuery(string|Closure $switch_inline_query): static
    {
        $this->switch_inline_query = $switch_inline_query;

        return $this;
    }

    protected function getSwitchInlineQuery(): ?string
    {
        return (string) $this->evaluate($this->switch_inline_query);
    }

    public function switchInlineQueryCurrentChat(string|Closure $switch_inline_query_current_chat): static
    {
        $this->switch_inline_query_current_chat = $switch_inline_query_current_chat;

        return $this;
    }

    protected function getSwitchInlineQueryCurrentChat(): ?string
    {
        return (string) $this->evaluate($this->switch_inline_query_current_chat);
    }

    public function callbackData(array|Closure $callback_data = []): static
    {
        $this->callback_data = $callback_data;

        return $this;
    }

    protected function getCallbackData(): ?string
    {
        $data = array_merge($this->getCallbackDataStructure(), $this->evaluate($this->callback_data));

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = implode(':', $value);
            }
        }

        return (string) implode('?', [
            'command' => $this->getCommand(),
            'data' => implode('|', $data),
        ]);
    }

    public function callbackDataStructure(array|Closure $callback_data_structure = []): static
    {
        $this->callback_data_structure = $callback_data_structure;

        return $this;
    }

    protected function getCallbackDataStructure(): array
    {
        return (array) $this->evaluate($this->callback_data_structure);
    }

    public function checkbox(string $checkbox, string $toggle): static
    {
        if ($this->callback_data) {
            throw new InvalidArgumentException('Checkbox can not be set when callback data is already set');
        }

        return $this->callbackData(function () use ($checkbox, $toggle) {
            $data = $this->getCallbackDataStructure();

            if (! isset($data[$checkbox]) or ! isset($data[$checkbox][$toggle])) {
                throw new InvalidArgumentException("Checkbox [{$checkbox}] or toggle [{$toggle}] not found");
            }

            $data[$checkbox][$toggle] = ! $data[$checkbox][$toggle];
            $prefix = $data[$checkbox][$toggle] ? '❌' : '✅';
            $this->text($prefix.$this->getText());

            return $data;
        });
    }

    public function render(): array
    {
        return array_filter([
            'callback_data' => (! $this->getUrl() and ! $this->getWebApp()) ? $this->getCallbackData() : null,
            'url' => $this->getUrl(),
            'text' => $this->getText(),
            'web_app' => $this->getWebApp(),
            'switch_inline_query' => $this->getSwitchInlineQuery(),
            'switch_inline_query_current_chat' => $this->getSwitchInlineQueryCurrentChat(),
        ]);
    }
}
