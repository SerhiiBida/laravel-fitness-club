<?php

namespace App\Services\Admin;

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

    public function store()
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
