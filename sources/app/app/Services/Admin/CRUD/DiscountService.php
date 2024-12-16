<?php

namespace App\Services\Admin\CRUD;

use App\Models\Discount;
use App\Repositories\Admin\DiscountRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DiscountService
{
    public function __construct(
        protected DiscountRepository $discountRepository
    )
    {

    }

    public function index(): LengthAwarePaginator
    {
        return $this->discountRepository->paginate(25);
    }

    public function create()
    {
        //
    }

    public function store(array $data): Discount
    {
        return Discount::create($data);
    }

    public function show(Discount $discount)
    {
        //
    }

    public function edit(Discount $discount)
    {

    }

    public function update(Discount $discount, array $data)
    {
        $discount->update($data);
    }

    public function destroy(Discount $discount): array
    {
        if ($discount->memberships()->exists()) {
            return ['status' => 'error', 'message' => 'This discount is already used.'];
        }

        $discount->delete();

        return ['status' => 'success'];
    }
}
