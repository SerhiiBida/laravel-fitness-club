<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected RoleRepositoryInterface $roleRepository,
    )
    {

    }

    // Отобразить все
    public function index()
    {
        $users = $this->userRepository->paginate(25);
        $roles = $this->roleRepository->all();

        return [$users, $roles];
    }

    // Форма создания
    public function create()
    {
        //
    }

    // Создание записи
    public function store()
    {
        //
    }

    // Отобразить одну запись
    public function show(User $user)
    {
        $roles = $this->roleRepository->all();

        return [$user, $roles];
    }

    // Форма редактирования
    public function edit()
    {
        //
    }

    // Обновление данных записи
    public function update()
    {
        //
    }

    // Удаление
    public function destroy()
    {
        //
    }
}
