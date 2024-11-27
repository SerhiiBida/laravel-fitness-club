<?php

namespace App\Models;

use App\Enums\TrainingRegistrationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingRegistration extends Model
{
    use HasFactory;

    public $timestamps = true;

    // Стандартные значения для полей
    protected $casts = [
        'status' => TrainingRegistrationStatus::class,
    ];

    // Внешние ключи
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
