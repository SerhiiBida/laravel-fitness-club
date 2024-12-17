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
    public function handle(Request $request, Closure $next, string $requiredPermissions): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $requiredPermissions = explode('|', $requiredPermissions);

        $check = false;

        foreach ($requiredPermissions as $permission) {
            if ($this->roleRepository->hasPermission($user->role_id, $permission)) {
                $check = true;

                break;
            }
        }

        if (!$check) {
            abort(403);
        }

        return $next($request);
    }
}
