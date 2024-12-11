<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainingType\StoreTrainingTypeRequest;
use App\Http\Requests\Admin\TrainingType\UpdateTrainingTypeRequest;
use App\Models\TrainingType;
use App\Services\Admin\TrainingTypeService;

class TrainingTypeController extends Controller
{
    public function __construct(
        protected TrainingTypeService $trainingTypeService
    )
    {
        $this->middleware('permission:view training_types')->only(['index', 'show']);
        $this->middleware('permission:create training_types')->only(['create', 'store']);
        $this->middleware('permission:edit training_types')->only(['edit', 'update']);
        $this->middleware('permission:delete training_types')->only(['destroy']);
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
    public function store(StoreTrainingTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingType $trainingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingType $trainingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingTypeRequest $request, TrainingType $trainingType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingType $trainingType)
    {
        //
    }
}
