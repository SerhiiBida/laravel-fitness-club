<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
        $this->middleware('permission:view users')->only(['index', 'show']);
        $this->middleware('permission:create users')->only(['create', 'store']);
        $this->middleware('permission:edit users')->only(['edit', 'update']);
        $this->middleware('permission:delete users')->only(['destroy']);
    }

    /**
     * Отобразить все
     */
    public function index()
    {
        list($users, $roles) = $this->userService->index();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Форма создания
     */
    public function create()
    {
        $roles = $this->userService->create();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Создание user
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $userId = $this->userService->store($request, $data);

        return redirect()->route('admin.users.show', $userId);
    }

    /**
     * Отобразить user
     */
    public function show(User $user)
    {
        list($user, $roles) = $this->userService->show($user);

        return view('admin.users.show', compact('user', 'roles'));
    }

    /**
     * Форма редактирования
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Обновление данных user
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Удаление user
     */
    public function destroy(User $user)
    {
        //
    }
}
