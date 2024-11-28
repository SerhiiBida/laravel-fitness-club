<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrainingType;
use Illuminate\Http\JsonResponse;

class TrainingTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['training_types' => TrainingType::all()]);
    }
}
