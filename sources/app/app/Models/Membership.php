<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    use HasFactory;

    // Автоматическое обновления create_at и update_at
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'validity_days',
        'bonuses',
        'is_published',
        'discount_id',
    ];

    // Внешние ключи
    public function discount(): belongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    // Отношения
    public function membershipPurchases(): hasMany
    {
        return $this->hasMany(MembershipPurchase::class);
    }

    // Отношение многие ко многим
    public function trainings(): BelongsToMany
    {
        return $this->belongsToMany(Training::class);
    }
}
