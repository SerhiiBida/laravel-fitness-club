<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MembershipPurchase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipPurchaseController extends Controller
{
    public function buy(Request $request): JsonResponse
    {
        return response()->json(['message' => 'Success']);
    }

    // Проверка, куплена ли
    public function check(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id',
            'membershipId' => 'required|integer|exists:memberships,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 400);
        }

        $userId = $request->input('userId');
        $membershipId = $request->input('membershipId');

        $currentData = date('Y-m-d H:i:s');

        // Куплен ли абонемент
        $check = MembershipPurchase::where('user_id', $userId)
            ->where('membership_id', $membershipId)
            ->where('is_active', 1)
            ->where('expired_at', '>', $currentData)
            ->exists();

        return response()->json([
            'is_purchased' => $check
        ]);
    }
}
