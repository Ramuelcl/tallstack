<?php

namespace Database\Factories\compras;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\compras\Vendedor;

class VendedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendedor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'razonSocial' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'nombres' => $this->faker->regexify('[A-Za-z0-9]{80}'),
            'apellidos' => $this->faker->regexify('[A-Za-z0-9]{80}'),
            'activo' => $this->faker->boolean,
            'eMail' => $this->faker->word,
        ];
    }
}
