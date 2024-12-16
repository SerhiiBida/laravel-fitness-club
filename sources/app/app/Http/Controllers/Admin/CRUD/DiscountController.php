<?php

namespace App\Http\Controllers\Admin\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\StoreDiscountRequest;
use App\Http\Requests\Admin\Discount\UpdateDiscountRequest;
use App\Models\Discount;
use App\Services\Admin\CRUD\DiscountService;

class DiscountController extends Controller
{
    public function __construct(
        protected DiscountService $discountService
    )
    {
        $this->middleware('permission:view discounts')->only(['index', 'show']);
        $this->middleware('permission:create discounts')->only(['create', 'store']);
        $this->middleware('permission:edit discounts')->only(['edit', 'update']);
        $this->middleware('permission:delete discounts')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = $this->discountService->index();

        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        $data = $request->validated();

        $discount = $this->discountService->store($data);

        return redirect()->route('admin.discounts.show', $discount->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        return view('admin.discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $data = $request->validated();

        $this->discountService->update($discount, $data);

        return redirect()->route('admin.discounts.show', $discount->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $result = $this->discountService->destroy($discount);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.discounts.index');
    }
}
