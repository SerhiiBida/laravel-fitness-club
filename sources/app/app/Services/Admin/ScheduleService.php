<?php

namespace App\Services\Admin;

use App\Models\Schedule;
use App\Repositories\Admin\ScheduleRepository;
use App\Repositories\Admin\TrainingRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function __construct(
        protected ScheduleRepository $scheduleRepository,
        protected TrainingRepository $trainingRepository,
        protected UserRepository     $userRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->scheduleRepository->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Collection
    {
        return $this->trainingRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data): Schedule
    {
        return Schedule::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule): Schedule
    {
        $schedule->load('training', 'users');

        return $schedule;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule): array
    {
        $schedule->load('training', 'users');

        $trainings = $this->trainingRepository->all();

        $users = $this->userRepository->all();

        return [$schedule, $trainings, $users];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Schedule $schedule, array $data): array
    {
        DB::beginTransaction();

        try {
            $selectedUsers = isset($data['users']) ? (array)$data['users'] : null;

            if ($selectedUsers) {
                // Очистка
                $selectedUsers = array_filter($selectedUsers, function ($item) {
                    return $item !== '' && $item !== null;
                });
            }

            unset($data['users']);

            $schedule->update($data);

            // Связь Schedule и User
            if ($selectedUsers) {
                $schedule->users()->sync($selectedUsers);
            } else {
                $schedule->users()->detach();
            }

            DB::commit();

            return ['status' => 'success'];

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error updating schedule: ' . $e->getMessage());

            return ['status' => 'error', 'message' => 'Please try again later.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule): array
    {
        if ($schedule->users()->exists()) {
            return ['status' => 'error', 'message' => 'The user has already visited it.'];
        }

        $schedule->delete();

        return ['status' => 'success'];
    }
}
