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
    public function store(StoreTrainingRegistrationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingRegistration $trainingRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingRegistration $trainingRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRegistrationRequest $request, TrainingRegistration $trainingRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingRegistration $trainingRegistration)
    {
        //
    }
}
