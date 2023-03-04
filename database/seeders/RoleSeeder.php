<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    // tabla roles
    protected $roles = [
        'user',
        'writer',
        'editor',
        'moderator',
        'cliente',
        'vendedor',
        'admin',
        'Super-admin',

        // 'sys_Blog',
        // 'sys_Banca',
        // 'sys_HorTrabajo',
    ];
    // tabla permisos
    protected $permissions1 = [
        'access',
    ];
    protected $permissions2 = [
        // CRUD
        'create',
        'read',
        'update',
        'delete',
    ];    // otros
    protected $permissions3 = [
        'publish',
        'unpublish',
        'printer',
        'export',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create permissions
        $perm = array_merge($this->permissions2, $this->permissions3);
        // Permission::create(['name' => 'access']);

        foreach ($this->roles as $rol) {
            $existe = false;
            foreach ($perm as $p) {
                if ($rol == 'cliente' || $rol == 'vendedor' || $rol == 'user') {
                    $name = $rol . ' ' . $p;
                } else {
                    $name = $p;
                }
                $existe = Permission::where('name', $name)->get();
                // dump($name, $existe->count());
                if (!$existe->count()) {
                    Permission::create(['name' => $name]);
                }
                // dump($name);
            }
        }

        // create roles and assign created permissions
        foreach ($this->roles as $value) {
            $role = Role::create(['name' => $value]);
            // dump($value);

            // asigna permisos a roles
            if ($value == 'admin') {
                // $role = Role::where('name', 'admin')->get();
                // dd($role);
                $role->syncPermissions(Permission::all());
            } elseif ($value == 'user' || $value == 'cliente' || $value == 'vendedor') {
                // $role = Role::findByName('user')->get();
                $role->syncPermissions(Permission::where('name', 'like', "%$value%")->get());
                // dd($role);
            } else {
                // $role = Role::findByName('user')->get();
                $role->syncPermissions($this->permissions2);
                // dd($role);
            }
        }

        $perm = array_merge($this->permissions1, $perm);

        // if ($role->name == 'admin' || $role->name == 'user') {
        //     $role->syncPermissions(Permission::all());
        // } elseif ($role->name == 'user') {
        //     $role->syncPermissions(Permission::where('name', 'like', "%user%")->get());
        // } elseif ($role->name == 'cliente') {
        //     $role->syncPermissions(Permission::where('name', 'like', "%cliente%")->get());
        // } elseif ($role->name == 'vendedor') {
        //     $role->syncPermissions(Permission::where('name', 'like', "%vendedor%")->get());
        // } elseif (substr($role->name, 0, 4) == 'sys_') {
        //     $role->syncPermissions("access");
        // } else {
        //     $role->syncPermissions(array_rand($perm, rand(1, 3)));
        // }



        // $role = Role::create(['name' => 'writer']);
        // $permission = Permission::create(['name' => 'edit articles']);
        // Se puede asignar un permiso a un rol mediante uno de estos métodos:

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        // Se pueden sincronizar varios permisos con un rol mediante uno de estos métodos:

        // $role->syncPermissions($permissions);
        // $permission->syncRoles($roles);
        // Se puede eliminar un permiso de un rol mediante uno de estos métodos:

        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);
    }
}
