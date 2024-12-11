<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MembershipPurchase\StoreMembershipPurchaseRequest;
use App\Http\Requests\Admin\MembershipPurchase\UpdateMembershipPurchaseRequest;
use App\Models\MembershipPurchase;
use App\Services\Admin\MembershipPurchaseService;

class MembershipPurchaseController extends Controller
{
    public function __construct(
        protected MembershipPurchaseService $membershipPurchaseService
    )
    {
        $this->middleware('permission:view membership_purchases')->only(['index', 'show']);
        $this->middleware('permission:create membership_purchases')->only(['create', 'store']);
        $this->middleware('permission:edit membership_purchases')->only(['edit', 'update']);
        $this->middleware('permission:delete membership_purchases')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membershipPurchases = $this->membershipPurchaseService->index();

        return redirect()->route('admin.membership_purchases.index', compact('membershipPurchases'));
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

