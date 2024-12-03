<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Training;
use Illuminate\Http\JsonResponse;

class GlobalSearchController extends Controller
{
    // Глобальный поиск
    public function search(string $name): JsonResponse
    {
        $memberships = Membership::select('id', 'name', 'image_path', \DB::raw('"membership" as type'))
            ->where('is_published', 1)
            ->where('name', 'like', '%' . $name . '%')
            ->orderBy('name')
            ->limit(5);

        $trainings = Training::select('id', 'name', 'image_path', \DB::raw('"training" as type'))
            ->where('is_published', 1)
            ->where('is_private', 0)
            ->where('name', 'like', '%' . $name . '%')
            ->orderBy('name')
            ->limit(5);

        // Убирает записи с одинаковым id
        $generalProducts = $memberships->union($trainings)->get();

        return response()->json($generalProducts);
    }
}
