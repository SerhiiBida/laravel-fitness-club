<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function current(): JsonResponse
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 201);
    }
}
