<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\DiscountRepositoryInterface;
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
        return Discount::query()->paginate($perPage);
    }
}
