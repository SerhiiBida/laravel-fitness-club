<?php

namespace App\Interfaces\Admin;

interface MembershipPurchaseRepositoryInterface
{
    public function all();

    public function paginate(int $perPage);
}
