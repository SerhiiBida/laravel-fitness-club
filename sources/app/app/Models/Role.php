<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    // Отношение с другими таблицами
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // многие ко многим
    public function permissions(): BelongsToMany
    {
        return $this->BelongsToMany(Permission::class);
    }
}
