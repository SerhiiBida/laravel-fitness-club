<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\MembershipPurchase\StoreMembershipPurchaseRequest;
use App\Http\Requests\Admin\MembershipPurchase\UpdateMembershipPurchaseRequest;
use App\Interfaces\Admin\MembershipPurchaseRepositoryInterface;
use App\Models\MembershipPurchase;
use Ramsey\Collection\Collection;

class MembershipPurchaseService
{
    public function __construct(
        protected MembershipPurchaseRepositoryInterface $membershipPurchaseRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return $this->membershipPurchaseRepository->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipPurchaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipPurchase $membershipPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipPurchase $membershipPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipPurchaseRequest $request, MembershipPurchase $membershipPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipPurchase $membershipPurchase)
    {
        //
    }
}
