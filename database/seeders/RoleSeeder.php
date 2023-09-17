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

        // Permisos para crud de tipos de documentos
        Permission::create(['name' => 'crud.admin.document_types.index'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.document_types.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.document_types.store'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.document_types.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'crud.admin.document_types.update'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.document_types.destroy'])->syncRoles([$admin]);

        // Permisos para crud de compañías
        Permission::create(['name' => 'crud.admin.companies.index'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.companies.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.companies.store'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.companies.edit'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.companies.update'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'crud.admin.companies.destroy'])->syncRoles([$admin, $manager]);
    }
}
