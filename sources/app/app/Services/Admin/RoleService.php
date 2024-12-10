<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\PermissionRepositoryInterface;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function __construct(
        protected RoleRepositoryInterface       $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository
    )
    {

    }

    public function index()
    {
        return $this->roleRepository->paginate(25);
    }

    public function create()
    {
        return $this->permissionRepository->all();
    }

    public function store($data): array
    {
        DB::beginTransaction();

        try {
            $selectedPermissions = (array)$data['permissions'];

            unset($data['permissions']);

            $role = Role::create($data);

            // Связь Role и Permissions
            $role->permissions()->sync($selectedPermissions);

            DB::commit();

            return ['status' => 'success', 'role' => $role];

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error creating role: ' . $e->getMessage());

            return ['status' => 'error', 'message' => 'Please try again later.'];
        }
    }

    public function show(Role $role)
    {
        return $this->roleRepository->find($role->id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
