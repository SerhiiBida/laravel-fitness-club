<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Форма создания
     */
    public function create()
    {
        //
    }

    /**
     * Создание user
     */
    public function store(StorePermissionRequest $request)
    {
        //
    }

    /**
     * Отобразить user
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Форма редактирования
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Обновление данных user
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //
    }

    /**
     * Удаление user
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
