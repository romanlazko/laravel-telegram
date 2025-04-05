<?php

namespace Romanlazko\LaravelTelegram\Models\Types\PaidMedia;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class PaidMedia extends BaseType
{
    public static function fromRequest(array $data, array $attributes = []): PaidMediaPreview|PaidMediaPhoto|PaidMediaVideo
    {
        $types = [
            'preview' => PaidMediaPreview::class,
            'photo' => PaidMediaPhoto::class,
            'video' => PaidMediaVideo::class,
        ];

        return $types[$data['type']]::fromRequest($data, $attributes);
    }
}
