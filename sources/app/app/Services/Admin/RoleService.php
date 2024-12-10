<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;

class RoleService
{
    public function __construct(
        protected RoleRepositoryInterface $roleRepository
    )
    {

    }

    public function index()
    {
        return $this->roleRepository->paginate(25);
    }

    public function create()
    {
        $rolePermissions = $this->roleRepository->getPermissions();
    }

    public function store()
    {
        //
    }

    public function show(string $id)
    {
        //
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
