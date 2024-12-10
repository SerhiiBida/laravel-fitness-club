<?php

namespace App\Http\Middleware;

use App\Repositories\Admin\RoleRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    public function __construct(
        protected RoleRepository $roleRepository
    )
    {

    }

    /**
     * Проверка доступа к контенту "персонала" сайта
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user && $user->is_staff) {
                // Все разрешения пользователя
                $permissions = $this->roleRepository->getPermissionNames($user->role_id);

                // Добавляем во все blades
                view()->share('permissions', $permissions);

                return $next($request);

            } else {
                abort(403);
            }
        }

        return redirect()->route('admin.showLogin');
    }
}
