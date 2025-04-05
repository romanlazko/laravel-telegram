<?php

namespace Romanlazko\LaravelTelegram\Models\Types\MenuButton;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MenuButton extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): MenuButtonCommands|MenuButtonWebApp|MenuButtonDefault
    {
        $types = [
            'commands' => MenuButtonCommands::class,
            'web_app' => MenuButtonWebApp::class,
            'default' => MenuButtonDefault::class,
        ];

        return $types[$data['type']]::fromRequest($data, $attributes);
    }
}
