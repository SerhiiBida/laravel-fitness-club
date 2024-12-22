<?php

namespace App\Services\Admin;

use App\Interfaces\MembershipPurchaseRepositoryInterface;
use App\Interfaces\MembershipRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\MembershipPurchase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MembershipPurchaseService
{
    public function __construct(
        protected MembershipPurchaseRepositoryInterface $membershipPurchaseRepository,
        protected MembershipRepositoryInterface         $membershipRepository,
        protected UserRepositoryInterface               $userRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->membershipPurchaseRepository->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): array
    {
        $memberships = $this->membershipRepository->all();

        $users = $this->userRepository->all();

        return [$memberships, $users];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data): MembershipPurchase
    {
        $data = array_filter($data, function ($value) {
            return $value !== "" && $value !== null;
        });

        return MembershipPurchase::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipPurchase $membershipPurchase): MembershipPurchase
    {
        $membershipPurchase->load(['membership', 'user']);

        return $membershipPurchase;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): array
    {
        $memberships = $this->membershipRepository->all();

        $users = $this->userRepository->all();

        return [$memberships, $users];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MembershipPurchase $membershipPurchase, array $data): void
    {
        $membershipPurchase->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipPurchase $membershipPurchase): void
    {
        $membershipPurchase->delete();
    }
}
