<?php

namespace App\Services\API;

use App\Interfaces\MembershipRepositoryInterface;
use Illuminate\Support\Collection;

class MembershipService
{
    public function __construct(
        protected MembershipRepositoryInterface $membershipRepository
    )
    {

    }

    public function show(int $id): array
    {
        $membership = $this->membershipRepository->find($id);

        if (!$membership) {
            return ['status' => 'error', 'message' => 'Access denied.', 'code' => 403];
        }

        return ['status' => 'success', 'membership' => $membership];
    }

    public function search(array $data): Collection
    {

    }
}
