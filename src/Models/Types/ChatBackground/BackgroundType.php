<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BackgroundType extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): BackgroundTypeFill|BackgroundTypeWallpaper|BackgroundTypePattern|BackgroundTypeChatTheme
    {
        $types = [
            'fill' => BackgroundTypeFill::class,
            'wallpaper' => BackgroundTypeWallpaper::class,
            'pattern' => BackgroundTypePattern::class,
            'chat_theme' => BackgroundTypeChatTheme::class,
        ];

        return $types[$data['type']]::fromRequest($data, $attributes);
    }
}
