<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\JsonResponse;

class MembershipController extends Controller
{
    public function searchWithPagination(): JsonResponse
    {
        return response()->json(Membership::query()->paginate());
    }
}
