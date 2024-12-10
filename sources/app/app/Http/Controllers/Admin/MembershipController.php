<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use app\Http\Requests\Admin\Membership\StoreMembershipRequest;
use app\Http\Requests\Admin\Membership\UpdateMembershipRequest;
use App\Models\Membership;
use App\Services\Admin\MembershipService;

class MembershipController extends Controller
{
    public function __construct(
        protected MembershipService $membershipService
    )
    {
        $this->middleware('permission:view memberships')->only(['index', 'show']);
        $this->middleware('permission:create memberships')->only(['create', 'store']);
        $this->middleware('permission:edit memberships')->only(['edit', 'update']);
        $this->middleware('permission:delete memberships')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = $this->membershipService->index();

        return view('admin.memberships.index', compact('memberships'));
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
