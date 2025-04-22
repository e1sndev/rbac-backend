<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CentralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // roles
            'viewAny roles',
            'view roles',
            'create roles',
            'update roles',
            'delete roles',

            // tenants
            'viewAny tenants',
            'create tenants',
            'delete tenants',

            // users
            'viewAny users',
            'view users',
            'create users',
            'update users',
            'delete users',
            'give role to users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'sanctum']);
        $admin->syncPermissions($permissions);

        $manager = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'sanctum']);
        $manager->syncPermissions([
            'viewAny roles',
            'view roles',

            'viewAny tenants',
            'create tenants',

            'create users',
            'viewAny users',
            'view users',
            'delete users',
            'update users',
        ]);

        $operator = Role::firstOrCreate(['name' => 'Operator', 'guard_name' => 'sanctum']);
        $operator->syncPermissions([
            'viewAny tenants',
            'viewAny roles',
            'viewAny users',
        ]);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole($admin);
    }
}
