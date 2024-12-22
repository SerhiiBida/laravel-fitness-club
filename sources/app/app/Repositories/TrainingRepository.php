<?php

namespace App\Repositories;

use App\Interfaces\TrainingRepositoryInterface;
use App\Models\Training;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TrainingRepository implements TrainingRepositoryInterface
{

    public function all(): Collection
    {
        return Training::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Training::with(['trainingType', 'user'])->paginate($perPage);
    }

    public function countPerMonth(int $year, int $month): int
    {
        return Training::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
    }
}
