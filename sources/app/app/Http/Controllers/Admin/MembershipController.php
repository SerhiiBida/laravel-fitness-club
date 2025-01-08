<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\StoreMembershipRequest;
use App\Http\Requests\Admin\Membership\UpdateMembershipRequest;
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
        $discounts = $this->membershipService->create();

        return view('admin.memberships.create', compact('discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->hasFile('image') ? $request->file('image') : null;

        $membership = $this->membershipService->store($data);

        return redirect()->route('admin.memberships.show', $membership->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        $membership = $this->membershipService->show($membership);

        return view('admin.memberships.show', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        list($membership, $discounts) = $this->membershipService->edit($membership);

        return view('admin.memberships.edit', compact('membership', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $data = $request->validated();

        $data['image'] = $request->hasFile('image') ? $request->file('image') : null;

        $this->membershipService->update($membership, $data);

        return redirect()->route('admin.memberships.show', $membership->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        $result = $this->membershipService->destroy($membership);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.memberships.index');
    }
}
