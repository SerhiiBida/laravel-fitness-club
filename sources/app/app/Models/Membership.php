<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    use HasFactory;

    // Автоматическое обновления create_at и update_at
    public $timestamps = true;

    // Внешние ключи
    public function bonus(): belongsTo
    {
        return $this->belongsTo(Bonus::class);
    }

    public function discount(): belongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    // Отношения
    public function membershipPurchase(): hasMany
    {
        return $this->hasMany(MembershipPurchase::class);
    }
}
