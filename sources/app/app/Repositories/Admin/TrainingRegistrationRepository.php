<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\TrainingRegistrationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TrainingRegistrationRepository implements TrainingRegistrationRepositoryInterface
{

    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement paginate() method.
    }
}
