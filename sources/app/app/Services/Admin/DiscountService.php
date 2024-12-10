<?php

namespace App\Services\Admin;

use App\Repositories\Admin\DiscountRepository;

class DiscountService
{
    public function __construct(
        protected DiscountRepository $discountRepository
    )
    {

    }
}
