<?php

namespace App\Services\Admin\CRUD;

use App\Interfaces\Admin\PermissionRepositoryInterface;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function __construct(
        protected RoleRepositoryInterface       $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository
    )
    {

    }

    public function index(): LengthAwarePaginator
    {
        return $this->roleRepository->paginate(25);
    }

    public function create(): Collection
    {
        return $this->permissionRepository->all();
    }

    public function store($data): array
    {
        DB::beginTransaction();

        try {
            $selectedPermissions = isset($data['permissions']) ? (array)$data['permissions'] : null;

            unset($data['permissions']);

            $role = Role::create($data);

            // Связь Role и Permissions
            if ($selectedPermissions) {
                $role->permissions()->sync($selectedPermissions);
            }

            DB::commit();

            return ['status' => 'success', 'role' => $role];

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error creating role: ' . $e->getMessage());

            return ['status' => 'error', 'message' => 'Please try again later.'];
        }
    }

    public function show(Role $role): Model
    {
        return $this->roleRepository->find($role->id);
    }

    public function edit(Role $role)
    {
        $role = $this->roleRepository->find($role->id);

        $allPermissions = $this->permissionRepository->all();

        return [$role, $allPermissions];
    }

    public function update(Role $role, array $data): array
    {
        DB::beginTransaction();

        try {
            $selectedPermissions = isset($data['permissions']) ? (array)$data['permissions'] : null;

            unset($data['permissions']);

            $role->update($data);

            // Связь Role и Permissions
            if ($selectedPermissions) {
                $role->permissions()->sync($selectedPermissions);
            } else {
                $role->permissions()->detach();
            }

            DB::commit();

            return ['status' => 'success', 'role' => $role];

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error updating role: ' . $e->getMessage());

            return ['status' => 'error', 'message' => 'Please try again later.'];
        }
    }

    public function destroy(Role $role): array
    {
        // Используется в trainings
        if ($role->users()->exists()) {
            return ['status' => 'error', 'message' => 'The role has users associated with it.'];
        }

        $role->delete();

        return ['status' => 'success'];
    }
}
