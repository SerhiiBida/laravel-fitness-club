<?php

namespace App\Services\API;

use App\Interfaces\MembershipRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MembershipService
{
    public function __construct(
        protected MembershipRepositoryInterface $membershipRepository
    )
    {

    }

    public function show(int $id): array
    {
        $membership = $this->membershipRepository->find($id, true);

        if (!$membership) {
            return ['status' => 'error', 'message' => 'Access denied.', 'code' => 403];
        }

        return ['status' => 'success', 'membership' => $membership];
    }

    public function search(array $data): LengthAwarePaginator
    {
        $perPage = (int)($data['perPage'] ?? 25);
        $search = $data['search'] ?? null;
        $filter = (int)($data['filter'] ?? null);
        $sort = $data['sort'] ?? null;

        return $this->membershipRepository->paginate($perPage, $search, $filter, $sort, true);
    }
}
