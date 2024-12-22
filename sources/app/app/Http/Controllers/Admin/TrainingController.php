<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Training\StoreTrainingRequest;
use App\Http\Requests\Admin\Training\UpdateTrainingRequest;
use App\Models\Training;
use App\Services\Admin\TrainingService;

class TrainingController extends Controller
{
    public function __construct(
        protected TrainingService $trainingService
    )
    {
        $this->middleware('permission:view trainings')->only(['index', 'show']);
        $this->middleware('permission:create trainings')->only(['create', 'store']);
        $this->middleware('permission:edit trainings')->only(['edit', 'update']);
        $this->middleware('permission:delete trainings')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = $this->trainingService->index();

        return view('admin.trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        list($trainingTypes, $users, $memberships) = $this->trainingService->create();

        return view('admin.trainings.create', compact('trainingTypes', 'users', 'memberships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->hasFile('image') ? $request->file('image') : null;

        $result = $this->trainingService->store($data);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.trainings.show', $result['training']->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        list($training, $trainingRegistrations) = $this->trainingService->show($training);

        return view('admin.trainings.show', compact('training', 'trainingRegistrations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        list($training, $trainingTypes, $users, $memberships) = $this->trainingService->edit($training);

        return view('admin.trainings.edit', compact('training', 'trainingTypes', 'users', 'memberships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $data = $request->validated();

        $result = $this->trainingService->update($request, $training, $data);

        if ($result['status'] === 'error') {
            return back()->withErrors(['errorMessage' => $result['message']]);
        }

        return redirect()->route('admin.trainings.show', $result['training']->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        $this->trainingService->destroy($training);

        return redirect()->route('admin.trainings.index');
    }
}
