<?php

namespace Database\Seeders;

use App\Env\PermissionsEnv;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionsEnv::initialize();

        // Разрешения
        $permissions = PermissionsEnv::$allPermissions;

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Роли и их разрешения
        $roles = [
            'admin' => PermissionsEnv::$admin,
            'user' => PermissionsEnv::$user,
            'trainer' => PermissionsEnv::$trainer,
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);

            // Получаем разрешения для роли
            $permissions = Permission::whereIn('name', $rolePermissions)->get();

            // Связываем роль с разрешениями
            $role->permissions()->attach($permissions);
        }
    }
}
