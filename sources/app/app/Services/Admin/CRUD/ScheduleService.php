<?php

namespace App\Services\Admin\CRUD;

use App\Mail\ScheduleChangeMail;
use App\Models\Schedule;
use App\Repositories\Admin\ScheduleRepository;
use App\Repositories\Admin\TrainingRegistrationRepository;
use App\Repositories\Admin\TrainingRepository;
use App\Repositories\Admin\UserRepository;
use App\Services\MailService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function __construct(
        protected ScheduleRepository             $scheduleRepository,
        protected TrainingRepository             $trainingRepository,
        protected UserRepository                 $userRepository,
        protected TrainingRegistrationRepository $trainingRegistrationRepository,
        protected MailService                    $mailService
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
    public function create(array $data): array
    {
        $trainings = $this->trainingRepository->all();

        $selectedTrainingId = $data['trainingId'] ?? 0;

        return [$trainings, $selectedTrainingId];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data): Schedule
    {
        $schedule = Schedule::create($data);

        $this->messageAboutChange($schedule);

        return $schedule;
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

            $this->messageAboutChange($schedule);

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
            return ['status' => 'error', 'message' => 'The user has already registered.'];
        }

        $schedule->delete();

        $this->messageAboutChange($schedule);

        return ['status' => 'success'];
    }

    // Отправка сообщения про изменения расписания
    public function messageAboutChange(Schedule $schedule): void
    {
        // Зарегистрированные на тренировку
        $trainingRegistrations = $this->trainingRegistrationRepository->allByTraining($schedule->training_id);

        if ($trainingRegistrations->isEmpty()) {
            return;
        }

        // Отправка сообщений
        foreach ($trainingRegistrations as $trainingRegistration) {
            $userEmail = $trainingRegistration->user->email;

            $mailData = [
                'username' => $trainingRegistration->user->username ?? $userEmail,
                'training' => $trainingRegistration->training->name,
            ];

            $this->mailService->send($userEmail, ScheduleChangeMail::class, $mailData);
        }
    }
}
