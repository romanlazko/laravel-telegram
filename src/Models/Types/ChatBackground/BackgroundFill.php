<?php

namespace Romanlazko\LaravelTelegram\Models\Types\ChatBackground;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class BackgroundFill extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient
    {
        $types = [
            'solid' => BackgroundFillSolid::class,
            'gradient' => BackgroundFillGradient::class,
            'freeform_gradient' => BackgroundFillFreeformGradient::class,
        ];

        return $types[$data['type']]::fromRequest($data, $attributes);
    }
}
