<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\backend\UserSetting;
use App\Models\backend\Perfil;

// agregamos
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

// Spatie
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\PermissionRegistrar;
// use Spatie\Permission\Models\model_has_roles;
// use Spatie\Permission\Models\model_has_permissions;

// The User model requires this trait
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{    // The User model requires this trait
    use HasRoles;
    public function __construct()
    {
        $users = [
            'admin' => [
                'name' => 'Super Admin',
                'email' => 'admin@email.com',
                'profile_photo_path' => '/storage/avatars/admin.png',
                'email_verified_at' => now(),
                // 'password' => Hash::make('0Admin'), //bcrypt('0Admin')
                'password' => '0Admin', //bcrypt('0Admin')
                'remember_token' => Str::random(10),
                'is_active' => 1,
            ],
            'guest' => [
                'name' => 'guest',
                'email' => 'guest@email.com',
                'profile_photo_path' => '/storage/avatars/guest.png',
                'email_verified_at' => now(),
                'password' => 'guest', //bcrypt('guest')
                'remember_token' => Str::random(10),
                'is_active' => 1,
            ],
        ];
        //
        // dd($users);
        //
        foreach ($users as $user) {
            $u = User::create($user);
            if ($user['name'] == 'Super Admin') {
                // dump('creando ' . $user['name']);
                $u->assignRole(['Super-Admin', 'admin']);
                // All current roles will be removed from the user and replaced by the array given
                // $user->syncRoles(['super-admin']);
                $theme = 'light';
                $language = 'es-ES';
            } else {
                // dump('creando ' . $user['name']);
                $u->assignRole('user');
                $theme = 'dark';
                $language = 'fr-FR';
            }
            //guardar un registro de configuracion para el usuario
            UserSetting::create([
                'user_id' => $u['id'],
                'theme' => $theme,
                'language' => $language,
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::factory()
        //     // ->has(UserSetting::factory()->count(1), 'userSetting')
        //     ->count(48)
        //     ->create();

        // factory(App\User::class, 25)->create()->each(function ($user) {
        //     $user->profile()->save(factory(App\UserProfile::class)->make());
        // });

        $roles = Role::all()->pluck('name')->toArray();
        User::factory(98)
            ->create()
            ->each(function ($user) use ($roles) {
                $user->assignRole(array_rand($roles), rand(1, 2));
                // dump($user);
                UserSetting::factory()->create([
                    'user_id' => $user->id,
                ]);
                Perfil::factory()->create([
                    'user_id' => $user->id,
                ]);
            });
    }
}
