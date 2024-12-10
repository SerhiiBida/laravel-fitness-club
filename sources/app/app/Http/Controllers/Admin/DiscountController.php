<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DiscountService;
use Illuminate\Http\Request;

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
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
