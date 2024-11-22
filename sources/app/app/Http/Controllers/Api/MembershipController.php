<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $sortOptions = ['name', 'discounted_price', 'validity_days', 'bonuses'];
        $filterOptions = [];

        $sort = $request->input('sort');
        $filter = filter_var($request->input('filter'), FILTER_VALIDATE_INT);
        $search = $request->input('search');
        $nextPage = $request->input('nextPage');
        $perPage = $request->input('perPage');

        // Сжатая загрузка с других таблиц
        $membershipQuery = Membership::query()
            ->leftJoin('discounts', 'memberships.discount_id', '=', 'discounts.id')
            ->select('memberships.*', 'discounts.percent');

        // Вычисляем поле с учетом скидки
        $membershipQuery->addSelect('(memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent) as discounted_price');

        // Фильтрация
        if ($request->filled('filter') && is_integer($filter) && $filter > 0 && $filter < 4){

        }

        // Сортировка
        if ($request->filled('sort') && is_string($sort) && in_array($sort, $sortOptions)) {
            $membershipQuery->orderBy($sort);
        }

        if ($request->filled('search')){

        }

        if ($request->filled('nextPage')){

        }

        if ($request->filled('perPage')){

        }

        return response()->json($membershipQuery->paginate(5));
    }
}
