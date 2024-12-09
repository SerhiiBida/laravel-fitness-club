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

        if (!$user) {
            abort(403);
        }

        // Все разрешения пользователя
        $permissions = $this->roleRepository->getPermissions($user->role_id);

        if (!in_array($permission, $permissions)) {
            abort(403);
        }

        // Добавляем во все blades
        view()->share('permissions', $permissions);

        return $next($request);
    }
}
