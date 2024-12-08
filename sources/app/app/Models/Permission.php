<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    public $timestamps = true;

    // Отношения с таблицами
    // многие ко многим
    public function roles(): BelongsToMany
    {
        return $this->BelongsToMany(Role::class);
    }
}
