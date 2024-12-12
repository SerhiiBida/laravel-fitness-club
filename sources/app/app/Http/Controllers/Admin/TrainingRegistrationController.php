<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainingRegistration\StoreTrainingRegistrationRequest;
use App\Http\Requests\Admin\TrainingRegistration\UpdateTrainingRegistrationRequest;
use App\Models\TrainingRegistration;
use App\Services\Admin\TrainingRegistrationService;

class TrainingRegistrationController extends Controller
{
    public function __construct(
        protected TrainingRegistrationService $trainingRegistrationService
    )
    {
        $this->middleware('permission:view training_registrations')->only(['index', 'show']);
        $this->middleware('permission:create training_registrations')->only(['create', 'store']);
        $this->middleware('permission:edit training_registrations')->only(['edit', 'update']);
        $this->middleware('permission:delete training_registrations')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainingRegistrations = $this->trainingRegistrationService->index();

        return view('admin.training_registrations.index', compact('trainingRegistrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        list($users, $trainings) = $this->trainingRegistrationService->create();

        return view('admin.training_registrations.create', compact('users', 'trainings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRegistrationRequest $request)
    {
        $data = $request->validated();

        $trainingRegistration = $this->trainingRegistrationService->store($data);

        return redirect()->route('admin.training_registrations.show', $trainingRegistration->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingRegistration $trainingRegistration)
    {
        $trainingRegistration = $this->trainingRegistrationService->show($trainingRegistration);

        return view('admin.training_registrations.show', compact('trainingRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingRegistration $trainingRegistration)
    {
        list($trainingRegistration, $users, $trainings) = $this->trainingRegistrationService->edit($trainingRegistration);

        return view('admin.training_registrations.edit', compact('trainingRegistration', 'users', 'trainings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRegistrationRequest $request, TrainingRegistration $trainingRegistration)
    {
        $data = $request->validated();

        $this->trainingRegistrationService->update($trainingRegistration, $data);

        return redirect()->route('admin.training_registrations.show', $trainingRegistration->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingRegistration $trainingRegistration)
    {
        $this->trainingRegistrationService->destroy($trainingRegistration);

        return redirect()->route('admin.training_registrations.index');
    }
}
