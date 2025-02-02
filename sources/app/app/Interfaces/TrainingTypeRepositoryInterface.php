<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TrainingTypeRepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;
}
