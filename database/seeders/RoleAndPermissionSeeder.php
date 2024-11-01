<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //permissions for prisoners CRUD

        Permission::create(['name' => 'index prisoner']);
        Permission::create(['name' => 'show prisoner']);
        Permission::create(['name' => 'create prisoner']);
        Permission::create(['name' => 'edit prisoner']);
        Permission::create(['name' => 'delete prisoner']);

        Permission::create(['name' => 'index cell']);
        Permission::create(['name' => 'show cell']);
        Permission::create(['name' => 'create cell']);
        Permission::create(['name' => 'edit cell']);
        Permission::create(['name' => 'delete cell']);

        Permission::create(['name' => 'index location']);
        Permission::create(['name' => 'show location']);
        Permission::create(['name' => 'create location']);
        Permission::create(['name' => 'edit location']);
        Permission::create(['name' => 'delete location']);

        Permission::create(['name' => 'index log']);
        Permission::create(['name' => 'show log']);
        Permission::create(['name' => 'create log']);
        Permission::create(['name' => 'edit log']);
        Permission::create(['name' => 'delete log']);

        Permission::create(['name' => 'index prisoncase']);
        Permission::create(['name' => 'show prisoncase']);
        Permission::create(['name' => 'create prisoncase']);
        Permission::create(['name' => 'edit prisoncase']);
        Permission::create(['name' => 'delete prisoncase']);


        Permission::create(['name' => 'index visitor']);
        Permission::create(['name' => 'show visitor']);
        Permission::create(['name' => 'create visitor']);
        Permission::create(['name' => 'edit visitor']);
        Permission::create(['name' => 'delete visitor']);


        Permission::create(['name' => 'index visit']);
        Permission::create(['name' => 'show visit']);
        Permission::create(['name' => 'create visit']);
        Permission::create(['name' => 'edit visit']);
        Permission::create(['name' => 'delete visit']);


        Permission::create(['name' => 'index historie']);
        Permission::create(['name' => 'show historie']);
        Permission::create(['name' => 'create historie']);
        Permission::create(['name' => 'edit historie']);
        Permission::create(['name' => 'delete historie']);

        $maatschappelijkwerker = Role::create(['name' => 'maatschappelijkwerker']);

        $opnameofficier = Role::create(['name' => 'opnameofficier'])
            ->givePermissionTo(['index prisoner', 'show prisoner', 'create prisoner', 'edit prisoner']);

        $portier = Role::create(['name' => 'portier'])
            ->givePermissionTo(['index prisoner', 'show prisoner']);

        $admin = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
    }
}
