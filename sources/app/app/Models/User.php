<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bonuses',
        'image_path',
        'is_staff',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Внешние ключи
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Отношения
    public function membershipPurchases(): hasMany
    {
        return $this->hasMany(MembershipPurchase::class);
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }

    public function trainingRegistrations(): HasMany
    {
        return $this->hasMany(TrainingRegistration::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    // Отношение многие ко многим
    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany(Schedule::class);
    }

    // Удаление связанных данных при удалении user
    protected static function booted()
    {
        static::deleting(function ($user) {
            $user->membershipPurchases()->delete();
            $user->trainingRegistrations()->delete();
            $user->reports()->delete();
            $user->schedules()->detach();
        });
    }
}
