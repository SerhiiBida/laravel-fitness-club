<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Schedule extends Model
{
    use HasFactory;

    // Автоматическое обновления create_at и update_at
    public $timestamps = true;

    // Внешние ключи
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    // Отношение многие ко многим
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
