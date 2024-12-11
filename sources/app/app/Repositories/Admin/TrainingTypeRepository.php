<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\TrainingTypeRepositoryInterface;
use App\Models\TrainingType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TrainingTypeRepository implements TrainingTypeRepositoryInterface
{

    public function all(): Collection
    {
        return TrainingType::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return TrainingType::paginate($perPage);
    }
}
