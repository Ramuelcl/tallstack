<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\Features;
use App\Models\Team;

use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->lastName();
        $prename = $this->faker->unique()->firstName();

        $i = $this->faker->numberBetween($min = 0, $max = 6);
        if ($i == 0) {
            $email = "$name$prename";
        } elseif ($i == 1) {
            $email = "$prename.$name";
        } elseif ($i == 2) {
            $email = "$name.$prename";
        } elseif ($i == 3) {
            $email = "$prename$name";
        } elseif ($i == 4) {
            $email = $name . '_' . $prename;
        } elseif ($i == 5) {
            $email = $prename . '_' . $name;
        } else {
            $email = $this->faker->userName();
        }
        $email = \fncCambiaCaracteresEspeciales($email);

        // $path=public_path('avatars');
        // $path2=storage_path();
        // $path2=public_path().'\\images\\';
        // $avatar= $this->faker->image($path, 640, 480, null, false);
        // $avatar1= $this->faker->imageUrl(640, 480, null, false);

        // $avatar= $this->faker->image(
        //     $dir = $folder,
        //     $width = 640,
        //     $height = 480,
        //     $category=$this->getIniciales($prename.' '.$name), /* usado como texto sobre la imagen,default null */
        //     $fullPath=true,
        //     $randomize=true,// it's a no randomize images (default: `true`)
        //     $word=null, //it's a filename without path
        //     $gray=false,
        //     $format='png'
        // );
        // dd($avatar, $avatar1, public_path('avatars'));
        // echo($avatar);
        // TODO: registrar foto en directorio, no se queda, se borra sola inmediatamente
        return [
            'name' => $name . " " . $prename,
            // 'prename' => $prename,
            'email' => $email . '@' . $this->faker->freeEmailDomain(),
            'email_verified_at' => now(),
            // 'profile_photo_path'=>$avatar1,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
