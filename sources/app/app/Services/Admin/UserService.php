<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        return $this->roleRepository->all();
    }

    // Создание записи
    public function store(StoreUserRequest $request, array $data)
    {
        // Убираем пустые значения
        $data = array_filter($data, function ($value) {
            return $value !== '' && $value !== null;
        });

        $password = Hash::make($data['password']);

        unset($data['password']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('users', 'public');
        }

        $user = User::create([
            ...$data,
            'password' => $password,
        ]);

        return $user->id;
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
