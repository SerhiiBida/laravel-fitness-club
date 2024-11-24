<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $sortOptions = ['name', 'discounted_price', 'validity_days', 'bonuses'];
        $filterOptions = [
            ['left' => 0, 'right' => 99],
            ['left' => 100, 'right' => 499],
            ['left' => 500, 'right' => 999],
            ['left' => 1000],
        ];

        $sort = $request->input('sort');
        $filter = filter_var($request->input('filter'), FILTER_VALIDATE_INT);
        $search = $request->input('search');
        $perPage = filter_var($request->input('perPage'), FILTER_VALIDATE_INT);

        // Основной запрос
        $membershipQuery = Membership::query()
            ->leftJoin('discounts', 'memberships.discount_id', '=', 'discounts.id')
            ->select('memberships.*', 'discounts.percent as discount_percent')
            ->where('memberships.is_published', '=', 1);

        // Вычисляем поле с учетом скидки
        $membershipQuery->addSelect(DB::raw('(memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent) as discounted_price'));

        // Поиск
        if ($request->filled('search')){
            $membershipQuery->where('memberships.name', 'like', '%'.$search.'%');
        }

        // Сортировка
        if ($request->filled('sort') && is_string($sort) && in_array($sort, $sortOptions)) {
            if($sort === 'discounted_price') {
                $membershipQuery->orderBy(DB::raw('(memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent)'));
            } else {
                $membershipQuery->orderBy($sort);
            }
        }

        // Фильтрация
        if ($request->filled('filter') && is_integer($filter) && $filter >= 0 && $filter < count($filterOptions)){
            if($filter === count($filterOptions) - 1) {
                $membershipQuery->having('discounted_price', '>=', $filterOptions[$filter]['left']);
            } else {
                $membershipQuery
                    ->having('discounted_price', '>=', $filterOptions[$filter]['left'])
                    ->having('discounted_price', '<=', $filterOptions[$filter]['right']);
            }
        }

        // Абонементов на странице
        if ($request->filled('perPage') && is_integer($perPage) && $perPage >= 0){
            $memberships = $membershipQuery->paginate($perPage);
        } else {
            $memberships = $membershipQuery->paginate(20);
        }

        return response()->json($memberships);
    }
}
