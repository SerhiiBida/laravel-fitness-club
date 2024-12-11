<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Training\StoreTrainingRequest;
use App\Http\Requests\Admin\Training\UpdateTrainingRequest;
use App\Models\Training;
use App\Repositories\Admin\MembershipRepository;
use App\Repositories\Admin\TrainingRegistrationRepository;
use App\Repositories\Admin\TrainingRepository;
use App\Repositories\Admin\TrainingTypeRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingService
{
    public function __construct(
        protected TrainingRepository             $trainingRepository,
        protected TrainingTypeRepository         $trainingTypeRepository,
        protected UserRepository                 $userRepository,
        protected MembershipRepository           $membershipRepository,
        protected TrainingRegistrationRepository $trainingRegistrationRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->trainingRepository->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): array
    {
        $trainingTypes = $this->trainingTypeRepository->all();

        $users = $this->userRepository->all();

        $memberships = $this->membershipRepository->all();

        return [$trainingTypes, $users, $memberships];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRequest $request, array $data): array
    {
        DB::beginTransaction();

        try {
            $selectedMemberships = isset($data['memberships']) ? (array)$data['memberships'] : null;

            unset($data['memberships']);

            // Есть фото
            if ($request->hasFile('image')) {
                $data['image_path'] = $request->file('image')->store('trainings', 'public');
            }

            $training = Training::create($data);

            // Связь Training и Membership
            if ($selectedMemberships) {
                $training->memberships()->sync($selectedMemberships);
            }

            DB::commit();

            return ['status' => 'success', 'training' => $training];

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error creating training: ' . $e->getMessage());

            return ['status' => 'error', 'message' => 'Please try again later.'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training): array
    {
        $training->load(['user', 'trainingType', 'memberships']);

        $registeredUsers = $this->trainingRegistrationRepository->registeredUsers($training->id);

        return [$training, $registeredUsers];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        $training->load(['user', 'trainingType', 'memberships']);

        $trainingTypes = $this->trainingTypeRepository->all();

        $users = $this->userRepository->all();

        $memberships = $this->membershipRepository->all();

        return [$training, $trainingTypes, $users, $memberships];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRequest $request, Training $training, array $data): array
    {
        DB::beginTransaction();

        try {
            $selectedMemberships = isset($data['memberships']) ? (array)$data['memberships'] : null;

            unset($data['memberships']);

            // Есть фото
            if ($request->hasFile('image')) {
                if (basename($training->image_path) !== 'default.png') {
                    Storage::disk('public')->delete($training->image_path);
                }

                $data['image_path'] = $request->file('image')->store('trainings', 'public');
            }

            $training->update($data);

            // Связь Training и Membership
            if ($selectedMemberships) {
                $training->memberships()->sync($selectedMemberships);
            } else {
                $training->memberships()->detach();
            }

            DB::commit();

            return ['status' => 'success', 'training' => $training];

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error updating training: ' . $e->getMessage());

            return ['status' => 'error', 'message' => 'Please try again later.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        // Удаляем изображение
        if (basename($training->image_path) !== 'default.png') {
            Storage::disk('public')->delete($training->image_path);
        }

        $training->delete();
    }
}
