<?php

namespace App\Services\Admin\CRUD;

use App\Models\TrainingType;
use App\Repositories\Admin\TrainingTypeRepository;

class TrainingTypeService
{
    public function __construct(
        protected TrainingTypeRepository $trainingTypeRepository
    )
    {

    }

    public function index()
    {
        return $this->trainingTypeRepository->paginate(25);
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
    public function store(array $data): TrainingType
    {
        return TrainingType::create($data);
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
    public function update(TrainingType $trainingType, array $data): void
    {
        $trainingType->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingType $trainingType)
    {
        // Уже используется в тренировках
        if ($trainingType->trainings()->exists()) {
            return ['status' => 'error', 'message' => 'Already used in training.'];
        }

        $trainingType->delete();

        return ['status' => 'success'];
    }
}
