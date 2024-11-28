<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    /**
     * Дать 1 абонемент
     */
    public function show(string $id): JsonResponse
    {
        // Абонемент
        $membershipQuery = Membership::query()
            ->leftJoin('discounts', 'memberships.discount_id', '=', 'discounts.id')
            ->select('memberships.*', 'discounts.percent as discount_percent')
            ->where('memberships.is_published', '=', 1)
            ->where('memberships.id', '=', $id);

        // Вычисляем поле с учетом скидки
        $membershipQuery->addSelect(DB::raw('ROUND((memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent), 2) as discounted_price'));

        $membership = $membershipQuery->first();

        if(!$membership){
            return response()->json(['message' => 'Access denied'], 403);
        }

        return response()->json([
            'membership' => $membershipQuery->first()
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'sort' => 'nullable|string',
            'filter' => 'nullable|integer|between:0,3',
            'search' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'perPage' => 'nullable|integer|min:1',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Incorrect data'], 400);
        }

        $sortOptions = ['name', 'discounted_price', 'validity_days', 'bonuses'];
        $filterOptions = [
            ['left' => 0, 'right' => 99],
            ['left' => 100, 'right' => 499],
            ['left' => 500, 'right' => 999],
            ['left' => 1000],
        ];

        $sort = $request->input('sort');
        $filter = (int)$request->input('filter');
        $search = $request->input('search');
        $perPage = (int)$request->input('perPage');

        // Основной запрос
        $membershipQuery = Membership::query()
            ->leftJoin('discounts', 'memberships.discount_id', '=', 'discounts.id')
            ->select('memberships.*', 'discounts.percent as discount_percent')
            ->where('memberships.is_published', '=', 1);

        // Вычисляем поле с учетом скидки
        $membershipQuery->addSelect(DB::raw('ROUND((memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent), 2) as discounted_price'));

        // Поиск
        if ($search){
            $membershipQuery->where('memberships.name', 'like', '%'.$search.'%');
        }

        // Сортировка
        if ($sort && in_array($sort, $sortOptions)) {
            if($sort === 'discounted_price') {
                $membershipQuery->orderBy(DB::raw('ROUND((memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent), 2)'));
            } else {
                $membershipQuery->orderBy($sort);
            }
        }

        // Фильтрация
        if ($filter){
            if($filter === count($filterOptions) - 1) {
                $membershipQuery->having('discounted_price', '>=', $filterOptions[$filter]['left']);
            } else {
                $membershipQuery
                    ->having('discounted_price', '>=', $filterOptions[$filter]['left'])
                    ->having('discounted_price', '<=', $filterOptions[$filter]['right']);
            }
        }

        // Записей на странице
        if ($perPage){
            $memberships = $membershipQuery->paginate($perPage);
        } else {
            $memberships = $membershipQuery->paginate(20);
        }

        return response()->json($memberships);
    }
}
