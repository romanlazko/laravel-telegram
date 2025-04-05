<?php

namespace Romanlazko\LaravelTelegram\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Romanlazko\LaravelTelegram\Models\Types\Chat;

class Conversation extends Model
{
    protected $table = 'telegram_conversations';

    protected $fillable = [
        'telegram_chat_id',
        'notes',
        'expectation',
    ];

    protected $casts = [
        'notes' => 'array',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'telegram_chat_id');
    }

    public function setExpectation($expectation)
    {
        $this->update([
            'expectation' => $expectation,
        ]);

        return $expectation;
    }

    public function getExpectation(): ?string
    {
        $expectation = $this->expectation;

        $this->update([
            'expectation' => null,
        ]);

        return $expectation;
    }

    public function notes(?array $notes = null)
    {
        $this->update([
            'notes' => $notes,
        ]);

        return $this->notes;
    }

    public function clear()
    {
        return $this->notes();
    }
}
