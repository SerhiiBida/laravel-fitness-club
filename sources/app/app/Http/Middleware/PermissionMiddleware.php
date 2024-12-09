<?php

namespace App\Http\Middleware;

use App\Repositories\Admin\RoleRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function __construct(
        protected RoleRepository $roleRepository
    )
    {

    }

    /**
     * Проверка, есть ли разрешение у пользователя
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();

        // Проверка права доступа
        if (!$user || !$this->roleRepository->hasPermission($user->role_id, $permission)) {
            abort(403);
        }

        // Разрешения пользователя во все blade
        $permissions = $this->roleRepository->getPermissions($user->role_id);

        view()->share('permissions', $permissions);

        return $next($request);
    }
}
