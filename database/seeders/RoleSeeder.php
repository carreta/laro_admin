<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $developer = Role::create(['name' => 'developer']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$admin, $manager]);

        // Permisos para crud de usuarios
        Permission::create(['name' => 'crud.admin.users.index'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.users.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.users.store'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.users.edit'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.users.update'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.users.destroy'])->syncRoles([$admin]);
    }
}
