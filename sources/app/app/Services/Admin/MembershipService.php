<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Membership\StoreMembershipRequest;
use App\Http\Requests\Admin\Membership\UpdateMembershipRequest;
use App\Interfaces\Admin\MembershipRepositoryInterface;
use App\Models\Membership;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MembershipService
{
    public function __construct(
        protected MembershipRepositoryInterface $membershipRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->membershipRepository->paginate(25);
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
    public function store(StoreMembershipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
