<?php

namespace App\Http\Controllers\Admin\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainingType\StoreTrainingTypeRequest;
use App\Http\Requests\Admin\TrainingType\UpdateTrainingTypeRequest;
use App\Models\TrainingType;
use App\Services\Admin\CRUD\TrainingTypeService;

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
        $trainingTypes = $this->trainingTypeService->index();

        return view('admin.training_types.index', compact('trainingTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.training_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingTypeRequest $request)
    {
        $data = $request->validated();

        $trainingType = $this->trainingTypeService->store($data);

        return redirect()->route('admin.training_types.show', $trainingType->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingType $trainingType)
    {
        return view('admin.training_types.show', compact('trainingType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingType $trainingType)
    {
        return view('admin.training_types.edit', compact('trainingType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingTypeRequest $request, TrainingType $trainingType)
    {
        $data = $request->validated();

        $this->trainingTypeService->update($trainingType, $data);

        return redirect()->route('admin.training_types.show', $trainingType->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingType $trainingType)
    {
        $result = $this->trainingTypeService->destroy($trainingType);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.training_types.index');
    }
}
