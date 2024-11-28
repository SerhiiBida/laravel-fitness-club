<?php

namespace App\Http\Controllers\Api;

use App\Enums\MembershipPurchaseStatus;
use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipPurchase;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MembershipPurchaseController extends Controller
{
    public function buy(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id',
            'membershipId' => 'required|integer|exists:memberships,id',
            'bonuses' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = $request->input('userId');
        $membershipId = $request->input('membershipId');
        $bonuses = $request->input('bonuses');

        $user = Auth::user();

        // Пользователь не действительный
        if ($user->id !== $userId) {
            return response()->json(['message' => 'Not a valid user'], 422);
        }

        // У user меньше бонусов чем передал
        if($bonuses > $user->bonuses) {
            return response()->json(['message' => 'Insufficient bonuses'], 422);
        }

        $currentDate = date('Y-m-d H:i:s');

        $oldMembership = MembershipPurchase::where('user_id', $userId)
            ->where('membership_id', $membershipId)
            ->where('status', MembershipPurchaseStatus::Paid)
            ->where('expired_at', '>', $currentDate);

        // Старый абонемент еще действительный
        if($oldMembership->exists()) {
            return response()->json(['message' => 'You have already purchased a membership'], 403);
        }

        $membership = Membership::query()
            ->leftJoin('discounts', 'memberships.discount_id', '=', 'discounts.id')
            ->select('memberships.*', DB::raw('ROUND((memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent), 2) as discounted_price'))
            ->where('memberships.is_published', '=', 1)
            ->where('memberships.id', '=', $membershipId)
            ->first();

        // Доступа к покупке нет(например, сняли с публикации)
        if(!$membership) {
            return response()->json(['message' => 'This membership cannot be purchased'], 403);
        }

        $discountedPrice = $membership->discounted_price;

        $bonusDiscountLimit = ($discountedPrice / 100) * 30;

        // Бонусов для скидки больше чем 30% от реальной цены
        if($bonuses > $bonusDiscountLimit) {
            return response()->json(['message' => 'Bonus discount no more than 30% of the price'], 422);
        }

        // Забираем бонусы у пользователя
        if($bonuses > 0) {
            $user->bonuses -= $bonuses;

            $user->save();
        }

        $endDate = date_create();

        $validityDays = $membership->validity_days;

        $endDate->modify("+$validityDays days");

        // Покупка
        MembershipPurchase::create([
            'membership_id' => $membershipId,
            'user_id' => $userId,
            'status' => MembershipPurchaseStatus::Paid,
            'expired_at' => $endDate->format('Y-m-d H:i:s')
        ]);

        // Даем бонусы user за покупку
        if($membership->bonuses > 0) {
            $user->bonuses += $membership->bonuses;

            $user->save();
        }

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
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = $request->input('userId');
        $membershipId = $request->input('membershipId');

        $currentData = date('Y-m-d H:i:s');

        // Куплен ли абонемент
        $check = MembershipPurchase::where('user_id', $userId)
            ->where('membership_id', $membershipId)
            ->where('status', MembershipPurchaseStatus::Paid)
            ->where('expired_at', '>', $currentData)
            ->exists();

        return response()->json([
            'is_purchased' => $check
        ]);
    }
}
