<?php

namespace App\Services\Admin;

use App\Models\TrainingRegistration;
use App\Repositories\TrainingRegistrationRepository;
use App\Repositories\TrainingRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TrainingRegistrationService
{
    public function __construct(
        protected TrainingRegistrationRepository $trainingRegistrationRepository,
        protected UserRepository                 $userRepository,
        protected TrainingRepository             $trainingRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->trainingRegistrationRepository->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): array
    {
        $users = $this->userRepository->all();

        $trainings = $this->trainingRepository->all();

        return [$users, $trainings];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data): TrainingRegistration
    {
        return TrainingRegistration::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingRegistration $trainingRegistration): TrainingRegistration
    {
        $trainingRegistration->load(['user', 'training']);

        return $trainingRegistration;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingRegistration $trainingRegistration): array
    {
        $trainingRegistration->load(['user', 'training']);

        $users = $this->userRepository->all();

        $trainings = $this->trainingRepository->all();

        return [$trainingRegistration, $users, $trainings];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainingRegistration $trainingRegistration, array $data): void
    {
        $trainingRegistration->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingRegistration $trainingRegistration): void
    {
        $trainingRegistration->delete();
    }
}
