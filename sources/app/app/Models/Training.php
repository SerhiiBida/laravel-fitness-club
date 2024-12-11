<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory;

    // Автоматическое обновления create_at и update_at
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'training_type_id',
        'user_id',
        'is_published',
        'is_private',
    ];

    // Внешние ключи
    public function trainingType(): BelongsTo
    {
        return $this->belongsTo(TrainingType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Отношения
    public function trainingRegistrations(): HasMany
    {
        return $this->hasMany(TrainingRegistration::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    // Отношение многие ко многим
    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class);
    }

    // Удаление связанных данных при удалении training
    protected static function booted()
    {
        static::deleting(function ($user) {
            $user->schedules()->delete();
            $user->trainingRegistrations()->delete();
            $user->memberships()->detach();
        });
    }


    // МЕТОДЫ:

    // IDs абонементов, что требует тренировка
    public static function getIdsRequiredMemberships(int $trainingId): array
    {
        return self::with('memberships')
            ->where('id', $trainingId)
            ->get()
            ->flatMap(fn($training) => $training->memberships->pluck('id'))
            ->unique()
            ->toArray();
    }
}
