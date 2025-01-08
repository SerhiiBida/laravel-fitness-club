<?php

namespace App\Repositories;

use App\Interfaces\DiscountRepositoryInterface;
use App\Models\Discount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DiscountRepository implements DiscountRepositoryInterface
{

    public function all(): Collection
    {
        return Discount::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Discount::paginate($perPage);
    }
}
