<?php

namespace Romanlazko\LaravelTelegram\Models\Types\Attachments\Sticker;

use Romanlazko\LaravelTelegram\Models\Types\BaseType;

class MaskPosition extends BaseType
{
    protected function casts(): array
    {
        return [
            'telegram_bot_id' => 'integer',
            'point' => 'string',
            'x_shift' => 'float',
            'y_shift' => 'float',
            'scale' => 'float',
        ];
    }
}
