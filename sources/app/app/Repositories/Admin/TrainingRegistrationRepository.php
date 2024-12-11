<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\TrainingRegistrationRepositoryInterface;
use App\Models\TrainingRegistration;
use App\Models\User;
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

    public function registeredUsers(int $trainingId): Collection
    {
        return User::whereHas('trainingRegistrations', function ($query) use ($trainingId) {
            $query->where('training_id', $trainingId)->where('status', 'active');
        })->get();
    }
}
