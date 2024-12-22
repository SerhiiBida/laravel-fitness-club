<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Training\UpdateTrainingRequest;
use App\Models\Training;
use App\Repositories\MembershipRepository;
use App\Repositories\TrainingRegistrationRepository;
use App\Repositories\TrainingRepository;
use App\Repositories\TrainingTypeRepository;
use App\Repositories\UserRepository;
use App\Services\FileService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TrainingService
{
    public function __construct(
        protected TrainingRepository             $trainingRepository,
        protected TrainingTypeRepository         $trainingTypeRepository,
        protected UserRepository                 $userRepository,
        protected MembershipRepository           $membershipRepository,
        protected TrainingRegistrationRepository $trainingRegistrationRepository,
        protected FileService                    $fileService
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
    public function store(array $data): array
    {
        DB::beginTransaction();

        try {
            $selectedMemberships = isset($data['memberships']) ? (array)$data['memberships'] : null;

            unset($data['memberships']);

            // Есть фото
            if (!is_null($data['image'])) {
                $data['image_path'] = $this->fileService->save($data['image'], 'trainings');
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
        $training->load([
            'user' => function ($query) {
                $query->orderBy('username');
            },
            'trainingType' => function ($query) {
                $query->orderBy('name');
            },
            'memberships' => function ($query) {
                $query->orderBy('name');
            },
            'schedules' => function ($query) {
                $query->orderBy('start_time');
            }
        ]);

        $trainingRegistrations = $this->trainingRegistrationRepository->allByTraining($training->id);

        return [$training, $trainingRegistrations];
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
                    $this->fileService->delete($training->image_path);
                }

                $data['image_path'] = $this->fileService->save($request->file('image'), 'trainings');
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
            $this->fileService->delete($training->image_path);
        }

        $training->delete();
    }
}
