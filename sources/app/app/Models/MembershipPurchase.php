<?php

namespace App\Models;

use App\Enums\MembershipPurchaseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipPurchase extends Model
{
    use HasFactory;

    // Автоматическое обновления create_at и update_at
    public $timestamps = true;

    // Поля, в которые можно добавлять данные
    protected $fillable = [
        'membership_id',
        'user_id',
        'status',
        'expired_at'
    ];

    // Стандартные значения для полей
    protected $casts = [
        'status' => MembershipPurchaseStatus::class,
    ];

    // Внешние ключи
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
