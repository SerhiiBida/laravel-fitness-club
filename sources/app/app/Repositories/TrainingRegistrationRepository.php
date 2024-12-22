<?php

namespace App\Repositories;

use App\Interfaces\TrainingRegistrationRepositoryInterface;
use App\Models\TrainingRegistration;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TrainingRegistrationRepository implements TrainingRegistrationRepositoryInterface
{

    public function all(): Collection
    {
        return TrainingRegistration::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return TrainingRegistration::with(['user', 'training'])->paginate($perPage);
    }

    public function allByTraining(int $trainingId): Collection
    {
        return TrainingRegistration::with(['user'])
            ->where('training_id', $trainingId)
            ->where('status', 'active')
            ->get();
    }
}
