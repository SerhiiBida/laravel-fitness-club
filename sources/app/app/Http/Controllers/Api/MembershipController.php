<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Membership\SearchMembershipRequest;
use App\Services\API\MembershipService;
use Illuminate\Http\JsonResponse;

class MembershipController extends Controller
{
    public function __construct(
        protected MembershipService $membershipService
    )
    {

    }

    /**
     * Дать 1 абонемент
     */
    public function show(string $id): JsonResponse
    {
        $result = $this->membershipService->show((int)$id);

        if ($result['status'] === 'error') {
            return response()->json(['message' => $result['message']], $result['code']);
        }

        return response()->json([
            'membership' => $result['membership']
        ]);
    }

    public function search(SearchMembershipRequest $request): JsonResponse
    {
        $data = $request->validated();

        $memberships = $this->membershipService->search($data);

        return response()->json($memberships);
    }
}
