<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bonus extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Отношения
    public function membership(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}
