<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    public $timestamps = true;

    // Отношения
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}
