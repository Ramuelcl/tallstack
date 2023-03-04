<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\backend\Perfil;

class PerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perfil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $edad = $this->faker->numberBetween($min = 18, $max = 65);
        //randomNumber($nbDigits = 2, $strict = false),
        $p = new Perfil;
        $profesion = $p->profesion_rnd();
        $biografia = ucwords($this->faker->words($this->faker->numberBetween(10, 93), $string = true));
// dd($profesion);
        return [
            // 'user_id' => $this->id,
            'edad' => $edad,
            'id_profesion' =>  $profesion[0],
            'biografia' => $biografia,
            'website' => $this->faker->url(),
        ];
    }
}
