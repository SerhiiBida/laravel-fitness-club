<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\StoreScheduleRequest;
use App\Http\Requests\Admin\Schedule\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Services\Admin\ScheduleService;

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
    public function store(StoreScheduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
