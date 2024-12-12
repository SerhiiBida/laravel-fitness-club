<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Membership\StoreMembershipRequest;
use App\Http\Requests\Admin\Membership\UpdateMembershipRequest;
use App\Interfaces\Admin\DiscountRepositoryInterface;
use App\Interfaces\Admin\MembershipRepositoryInterface;
use App\Models\Membership;
use App\Services\FileService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MembershipService
{
    public function __construct(
        protected MembershipRepositoryInterface $membershipRepository,
        protected DiscountRepositoryInterface   $discountRepository,
        protected FileService                   $fileService
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->membershipRepository->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->discountRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipRequest $request, array $data): Membership
    {
        $data = array_filter($data, function ($value) {
            return $value !== "" && $value !== null;
        });

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->fileService->save($request->file('image'), 'memberships');
        }

        return Membership::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        $membership->load('discount');

        return $membership;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership): array
    {
        $membership->load('discount');

        $discounts = $this->discountRepository->all();

        return [$membership, $discounts];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership, array $data): void
    {
        if ($request->hasFile('image')) {
            if (basename($membership->image_path) !== 'default.png') {
                $this->fileService->delete($membership->image_path);
            }

            $data['image_path'] = $this->fileService->save($request->file('image'), 'memberships');
        }

        $membership->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership): array
    {
        // Куплена пользователем
        if ($membership->membershipPurchases()->exists()) {
            return ['status' => 'error', 'message' => 'This membership was purchased by a user.'];
        }

        // Требуется в тренировках
        if ($membership->trainings()->exists()) {
            return ['status' => 'error', 'message' => 'The membership is used in training'];
        }

        // Удаляем изображение
        if (basename($membership->image_path) !== 'default.png') {
            $this->fileService->delete($membership->image_path);
        }

        $membership->delete();

        return ['status' => 'success'];
    }
}
