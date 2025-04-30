<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'view divisions',
            'create division',
            'update division',
            'delete division',
            'view departments',
            'create department',
            'update department',
            'delete department',
            'view employees',
            'create employee',
            'update employee',
            'delete employee',
            'view trainings',
            'create training',
            'update training',
            'delete training',
            'view payrolls',
            'create payroll',
            'update payroll',
            'delete payroll',
            'view users',
            'create user',
            'update user',
            'delete user',
            'view roles',
            'create role',
            'update role',
            'delete role',
            'view dashboard',
            'view leaves',
            'create leave',
            'approve leave',
            'reject leave',
            'manage employees',
            'export leaves',
            'export employees',
            'view payroll',
            'manage roles',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $rolePermissions = [
            'Admin' => $permissions,
            'HR Manager' => ['view leaves', 'approve leave', 'reject leave', 'manage employees', 'export leaves', 'export employees', 'view payroll'],
            'Supervisor' => ['view leaves', 'approve leave', 'reject leave'],
            'Employee' => ['view leaves', 'create leave', 'view dashboard', 'view payroll'],
        ];

        foreach ($rolePermissions as $roleName => $perms) {
            $role = \Spatie\Permission\Models\Role::where('name', $roleName)->first();
            if ($role) {
                $role->syncPermissions($perms);
            }
        }
    }
}
