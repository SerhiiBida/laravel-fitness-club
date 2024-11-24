<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MembershipPurchase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembershipPurchaseController extends Controller
{
    // Проверка, куплена ли
    public function check(Request $request): JsonResponse
    {
        $userId = filter_var($request->input('userId'), FILTER_VALIDATE_INT);
        $membershipId = filter_var($request->input('membershipId'), FILTER_VALIDATE_INT);

        if (!$userId || !$membershipId || $userId < 1 || $membershipId < 1) {
            return response()->json(['message' => 'Incorrect data format'], 400);
        }

        $currentData = date('Y-m-d H:i:s');

        $check = MembershipPurchase::where('user_id', $userId)
            ->where('membership_id', $membershipId)
            ->where('is_active', 1)
            ->where('expired_at', '>', $currentData)
            ->exists();

        // НЕ РАБОТАЕЕЕЕЕЕЕЕЕЕЕЕЕЕТ
        return response()->json([
            'is_purchased' => (bool)$check,
        ]);
    }
}
