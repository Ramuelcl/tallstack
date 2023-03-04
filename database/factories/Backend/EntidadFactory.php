<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Entidad;

class EntidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entidad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo' => $this->faker->randomElement(["perfil","cliente","proveedor","cli_pro"]),
            'razonSocial' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'nombres' => $this->faker->regexify('[A-Za-z0-9]{80}'),
            'apellidos' => $this->faker->regexify('[A-Za-z0-9]{80}'),
            'activo' => $this->faker->boolean,
            'eMail' => $this->faker->word,
        ];
    }
}
