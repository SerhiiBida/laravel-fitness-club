<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('users', 'public');
        }

        $user = User::create($data);

        return $user->id;
    }

    // Отобразить одну запись
    public function show(User $user)
    {
        $roles = $this->roleRepository->all();

        return [$user, $roles];
    }

    // Форма редактирования
    public function edit(User $user)
    {
        $roles = $this->roleRepository->all();

        return [$user, $roles];
    }

    // Обновление данных записи
    public function update(UpdateUserRequest $request, User $user, array $data)
    {
        // Убираем пустые значения
        $data = array_filter($data, function ($value) {
            return $value !== '' && $value !== null;
        });

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Обновление фото
        if ($request->hasFile('image')) {
            if (basename($user->image_path) !== 'default.png') {
                Storage::disk('public')->delete($user->image_path);
            }

            $data['image_path'] = $request->file('image')->store('users', 'public');
        }

        $user->update($data);
    }

    // Удаление
    public function destroy(User $user): array
    {
        // Используется в trainings
        if ($user->trainings()->exists()) {
            return ['status' => 'error', 'message' => 'This user has trainings.'];
        }

        $imageName = basename($user->image_path);

        // Удаляем изображение
        if ($imageName !== 'default.png') {
            Storage::disk('public')->delete($user->image_path);
        }

        $user->delete();

        return ['status' => 'success'];
    }
}
