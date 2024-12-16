<?php

namespace App\Http\Controllers\Admin\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\CreateScheduleRequest;
use App\Http\Requests\Admin\Schedule\StoreScheduleRequest;
use App\Http\Requests\Admin\Schedule\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Services\Admin\CRUD\ScheduleService;

class ScheduleController extends Controller
{
    public function __construct(
        protected ScheduleService $scheduleService
    )
    {
        $this->middleware('permission:view schedules')->only(['index', 'show']);
        $this->middleware('permission:create schedules')->only(['create', 'store']);
        $this->middleware('permission:edit schedules')->only(['edit', 'update']);
        $this->middleware('permission:delete schedules')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = $this->scheduleService->index();

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateScheduleRequest $request)
    {
        $data = $request->validated();

        list($trainings, $selectedTrainingId) = $this->scheduleService->create($data);

        return view('admin.schedules.create', compact('trainings', 'selectedTrainingId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $data = $request->validated();

        $schedule = $this->scheduleService->store($data);

        return redirect()->route('admin.schedules.show', $schedule->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule = $this->scheduleService->show($schedule);

        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        list($schedule, $trainings, $users) = $this->scheduleService->edit($schedule);

        return view('admin.schedules.edit', compact('schedule', 'trainings', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $data = $request->validated();

        $result = $this->scheduleService->update($schedule, $data);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.schedules.show', $schedule->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $result = $this->scheduleService->destroy($schedule);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.schedules.index');
    }
}
